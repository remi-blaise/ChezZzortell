<?php

namespace Zz\ChezZzortellBundle\Notebook;

use Symfony\Component\Yaml\Yaml;
use Parsedown;
use Symfony\Component\Config as Config;
use Symfony\Component\Validator\Constraints as Assert;

class NoteFactory
{
	protected $kernel;
	protected $validator;
	
	public function __construct (
		\Symfony\Component\HttpKernel\KernelInterface $kernel,
		\Symfony\Component\Validator\ValidatorInterface $validator
	) {
		$this->kernel = $kernel;
		$this->validator = $validator;
	}
	
	public function get ( $id ) {
		if ( !is_int($id) ) {
			throw new \InvalidArgumentException ('The $id param must be a integer. '.$id.' given.');
		}
		
		$cachePath = $this->kernel->getCacheDir() . '/zz_chez_zzortell/notes/' . $id . '.php';
		$cache = new Config\ConfigCache($cachePath, $this->kernel->isDebug()); 
		
		if ( !$cache->isFresh() ) {
			$content = $this->getResourcesContent($id);
			$note = new Note ($content['datas']);
			
			$errors = $this->validator->validate($note);
			if ( count($errors) > 0 ) {
				throw new \LogicException (
					'La note '.$id.' n\'est pas valide.'.PHP_EOL.
					'Erreur sur la propriété $'.$errors[0]->getPropertyPath().' = '.
					$errors[0]->getInvalidValue().' :'.PHP_EOL.$errors[0]->getMessage()
				);
			}
			
			$this->cacheNote($note, $cache, $content['resources']);
			
			return $note;
		}
		
		return require $cache;
	}
	
	protected function getResourcesContent ( $id ) {
		//Get files' content
		$pathWithoutExt = __DIR__ . '/../Resources/notes/' . $id;
		$resources = [];
		
		if ( file_exists($pathWithoutExt . '.yml+md') ) {
			$ymlAndMd = file_get_contents($pathWithoutExt . '.yml+md');
			$resources[] = new Config\Resource\FileResource ($pathWithoutExt . '.yml+md');
			
			$matches = preg_split('#\n\n#', $ymlAndMd, 2);
			if ( count($matches) < 2 ) {
				throw new \LogicException (
					'YAML and Markdown should be separated by two LF in'.PHP_EOL.$pathWithoutExt.'.yml+md'
				);
			}
			$ymlToParse = $matches[0];
			$mdToParse = $matches[1];
		} elseif ( file_exists($pathWithoutExt . '.yml') ) {
			$ymlToParse = file_get_contents($pathWithoutExt . '.yml');
			$resources[] = new Config\Resource\FileResource ($pathWithoutExt . '.yml');
			
			if ( file_exists($pathWithoutExt . '.md') ) {
				$mdToParse = file_get_contents($pathWithoutExt . '.md');
				$resources[] = new Config\Resource\FileResource ($pathWithoutExt . '.md');
			}
		} else {
			throw new \InvalidArgumentException ('The note ' . $id . ' doesn\'t exist.');
		}
		
		//Parse files' content
		$datas = Yaml::parse($ymlToParse);
		
		if ( isset($mdToParse) ) {
			$mdParser = new Parsedown;
			$datas['content'] = $mdParser->text($mdToParse);
		}
		
		$datas['id'] = $id;
		
		return [ 'datas' => $datas, 'resources' => $resources ];
	}
	
	protected function cacheNote ( Note $note, Config\ConfigCache $cache, array $resources ) {
		$datas = $note->getDatas();
		$content = sprintf(<<<EOF
<?php
use Zz\ChezZzortellBundle\Notebook\Note;
\$note = new Note( %s );

return \$note;
EOF
            ,
            var_export($datas, true)
        );
		
		$cache->write($content, $resources);
	}
}