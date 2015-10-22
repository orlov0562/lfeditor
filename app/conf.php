<?php
	setConf('admin.password', 'admin');
	
	setConf('env', 'dev'); // dev / prod
	
	setConf('url.rewrite', true);
	
	setConf('route.aliases', [
		'home' => 'index/index',
		'login' => 'login/form',		
		'404' => 'errors/err404',
		'503' => 'errors/err503',		
	]);	
	
	setConf('files', [
		'test'=>[
			'menu' => 'Test',
			'path' => ROOT_DIR.'/files/test.txt',
		],		
	]);
	
	setConf('per.page', 25);

	setConf('check.new.lines.for.unique', true);	
	setConf('check.new.lines.ignore.case', true);
