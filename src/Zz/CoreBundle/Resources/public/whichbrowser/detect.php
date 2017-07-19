<?php

	  // Install with --symlink
if ( !@include '../../../../../../vendor/whichbrowser/whichbrowser/detect.php' ) {
	// Install as hard copy
	include '../../../../vendor/whichbrowser/whichbrowser/detect.php';
}
