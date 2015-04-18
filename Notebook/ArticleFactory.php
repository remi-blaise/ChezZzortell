<?php

namespace Zz\ChezZzortellBundle\Notebook;

use Symfony\Component\Yaml\Yaml,
	Parsedown;

class ArticleFactory
{
	public static function get ( $id ) {
		if ( !is_int($id) ) {
			throw new InvalidArgumentException;
		}
		
		$pathWithoutExt = __DIR__ . '/../Resources/articles/' . $id;
		
		$datas = Yaml::parse(file_get_contents( $pathWithoutExt . '.yml' ));
		
		if ( !isset($datas['content']) ) {
			$mdParser = new Parsedown;
			$datas['content'] = $mdParser->text(file_get_contents( $pathWithoutExt . '.md' ));
		}
		
		$datas['id'] = $id;
		
		return new Article($datas);
	}
}