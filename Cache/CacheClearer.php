<?php

namespace Zz\ChezZzortellBundle\Cache;

use Symfony\Component\HttpKernel\CacheClearer\CacheClearerInterface;

class CacheClearer implements CacheClearerInterface
{
	public function clear ( $cacheDir ) {
		$this->delete($cacheDir . '/zz_chez_zzortell');
	}
	
	protected function delete ( $path )
	{
		if ( is_dir($path) ) {
			$files = new \RecursiveIteratorIterator(
				new \RecursiveDirectoryIterator($path), \RecursiveIteratorIterator::CHILD_FIRST
			);

			foreach ( $files as $file ) {
				if ( !in_array($file->getBasename(), array('.', '..')) ) {
					if ( $file->isDir() ) {
						rmdir($file->getPathName());
					} elseif ( $file->isFile() || $file->isLink() ) {
						unlink($file->getPathname());
					}
				}
			}

			return rmdir($path);
		} elseif ( is_file($path) || is_link($path) ) {
			return unlink($path);
		}

		return false;
	}
}