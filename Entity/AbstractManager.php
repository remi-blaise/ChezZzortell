<?php

namespace Zz\ChezZzortellBundle\Entity;

use Symfony\Component\Config as Config;
use Zz\ChezZzortellBundle\Tool\Paginator;

abstract class AbstractManager
{
	const ID_LENGTH_IN_FILENAME = 3;
	
	protected $kernel;
	protected $validator;
	protected $ymlParser;
	protected $mdParser;
	
	public function __construct (
		\Symfony\Component\HttpKernel\KernelInterface $kernel,
		\Symfony\Component\Validator\ValidatorInterface $validator,
		\Symfony\Component\Yaml\Parser $ymlParser,
		\Parsedown $mdParser
	) {
		$this->kernel = $kernel;
		$this->validator = $validator;
		$this->ymlParser = $ymlParser;
		$this->mdParser = $mdParser;
	}
	
	public function get ( $id ) {
		if ( !is_int($id) ) {
			throw new \InvalidArgumentException ('The $id param must be a integer. '.$id.' given.');
		}
		
		$cachePath = $this->getCacheDir().'/'.$id.'.php';
		$cache = new Config\ConfigCache($cachePath, $this->kernel->isDebug());
		
		if ( !$cache->isFresh() ) {
			$resources = $this->getResources($id);
			$datas = $this->getResourcesDatas($resources);
			$datas['id'] = $id;
			$entityClassName = $this->getEntityClassName();
			$entity = new $entityClassName ($datas);
			
			$errors = $this->validator->validate($entity);
			if ( count($errors) > 0 ) {
				throw new \LogicException (
					'La '.$this->getEntityName().' '.$id.' n\'est pas valide.'.PHP_EOL.
					'Erreur sur la propriété $'.$errors[0]->getPropertyPath().' = '.
					$errors[0]->getInvalidValue().' :'.PHP_EOL.$errors[0]->getMessage()
				);
			}
			
			$this->cacheEntity($entity, $cache, $resources);
			
			return $entity;
		}
		
		return require $cache;
	}
	
	public function getEntities ( $limit = null, $offset = 0, array $tags = null ) {
		if ( !is_int($limit) && !is_null($limit) ) {
			throw new \InvalidArgumentException ('The $limit argument must be an int or null.');
		}
		if ( !is_int($offset) ) {
			throw new \InvalidArgumentException ('The $offset argument must be an int or null.');
		}
		
		$index = array_reverse($this->getIndex(), true);
		
		if ( $tags ) {
			foreach ( $tags as $tag ) {
				foreach ( $index as $id => $tags ) {
					if ( !in_array($tag, $tags) ) {
						unset($index[$id]);
					}
				}
			}
		}
		
		$nbEntities = count($index);
		
		$index = array_slice($index, $offset, $limit, true);
		
		$entities = [];
		foreach ( $index as $id => $tags ) {
			$entities[] = $this->get($id);
		}
		return new Paginator ($entities, $nbEntities);
	}
	
	protected function getIndex () {
		$cachePath = $this->getCacheDir().'/index.php';
		$cache = new Config\ConfigCache($cachePath, $this->kernel->isDebug());
		
		if ( !$cache->isFresh() ) {
			$index = [];
			
			$dir = $this->getResourcesDir();
			if ( ! $list = scandir($dir) ) {
				throw new \LogicalException ('Fail to list '.$dir);
			}
			
			foreach ( $list as $filename ) {
				$matches = [];
				if (
					is_file($dir.'/'.$filename)
					&& preg_match('#^(\d+)\.yml\+md$#i', $filename, $matches)
				) {
					$id = (int) $matches[1];
					$index[$id] = $this->get($id)->getTags();
				}
			}
			
			$content = '<?php return ' . var_export($index, true) . ';';
			$resources = [ new Config\Resource\DirectoryResource ($this->getResourcesDir()) ];
			$cache->write($content, $resources);
			
			return $index;
		}
		
		return require $cache;
	}
	
	protected function getResources ( $id ) {
		$path = $this->getResourcesDir() .DIRECTORY_SEPARATOR. $this->formatIdForFilename($id) . '.yml+md';
		$resources = [];
		
		if ( file_exists($path) ) {
			$resources[] = new Config\Resource\FileResource ($path);
		} else {
			throw new \InvalidArgumentException (
				'The '.strtolower($this->getEntityName()).' ' . $id . ' doesn\'t exist. ' . $path
			);
		}
		
		return $resources;
	}
	
	protected function formatIdForFilename ( $id ) {
		$id = (string) $id;
		if ( strlen($id) > self::ID_LENGTH_IN_FILENAME ) {
			throw new \InvalidArgumentException (
				'The max length for ' . strtolower($this->getEntityName()) . '\'id is ' .
				self::ID_LENGTH_IN_FILENAME .', $id given: ' . $id
			);
		}
		while ( strlen($id) < self::ID_LENGTH_IN_FILENAME ) {
			$id = '0' . $id;
		}
		return $id;
	}
	
	protected function getResourcesDatas ( array $resources ) {
		foreach ( $resources as $resource ) {
			$content = file_get_contents($resource);
			if ( pathinfo($resource, PATHINFO_EXTENSION) === 'yml+md' ) {
				$matches = preg_split('#\n\n#', $content, 2);
				if ( count($matches) < 2 ) {
					throw new \LogicException (
						'YAML and Markdown should be separated by two LF in' . PHP_EOL . $resource
					);
				}
				$datas = $this->ymlParser->parse($matches[0]);
				$datas['content'] = $this->mdParser->text($matches[1]);
			} else {
				throw new \LogicalException;
			}
		}
		
		return $datas;
	}
	
	protected function cacheEntity ( $entity, Config\ConfigCache $cache, array $resources ) {
		$content = sprintf(<<<'EOF'
<?php
$entity = new \%s( %s );

return $entity;
EOF
            ,
			get_class($entity),
            var_export($entity->getDatas(), true)
        );
		
		$cache->write($content, $resources);
	}
	
	protected function getEntityNamespace () {
		return __NAMESPACE__;
	}
	
	protected function getEntityName () {
		$className = substr(strrchr(get_class($this), '\\'), 1);
		$entityName = str_replace('Manager', '', $className);
		return $entityName;
	}
	
	private function getEntityClassName () {
		return '\\' . $this->getEntityNamespace() . '\\' . $this->getEntityName();
	}
	
	protected function getFolderName () {
		return strtolower($this->getEntityName()).'s';
	}
	
	protected function getResourcesDir () {
		return __DIR__ . '/../Resources/' . $this->getFolderName();
	}
	
	protected function getCacheDir () {
		return $this->kernel->getCacheDir() . '/zz_chez_zzortell/' . $this->getFolderName();
	}
}