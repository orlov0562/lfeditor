<?php

	// Controllers loader

	spl_autoload_register(function ($class) {
		if (preg_match('~^.+Controller$~', $class)) {
			$classPath = ROOT_DIR.'/app/controllers/'.$class.'.php';
			if (file_exists($classPath)) {
				require_once($classPath);
			}
		}
	});
