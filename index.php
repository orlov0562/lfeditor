<?php
	
	define('ROOT_DIR', dirname(__FILE__));

	require_once('app/loader.php');	
	require_once('app/func.php');
	require_once('app/conf.php');

	if( !session_id() ) @session_start();

	$alias = getRequestVar('r', getRouteFromAlias('home'));
	$r = getRouteFromAlias($alias);

	$request = [
		'baseUrl' => getBaseUrl(),
		'alias' => $alias,
		'plain' => rtrim($r,'/'),
		'parsed' => explode('/', $r), 
	];
	setConf('_request', $request);	
	
	$route = [
		'controller' => getArrVar($request['parsed'], 0, 'index'),
		'action' => getArrVar($request['parsed'], 1, 'index'),
		'params' => isset($request['parsed'][2]) ? array_slice($request['parsed'], 2) : [],
	];
	setConf('_route', $route);

	try {
		processRoute($route);
	} catch (Exception $e) {
		if (isEnvMode('dev')) {
			throw $e;
		} else {
			redirectToRoute(getRouteFromAlias('503'));					
		}
	}
		
	

	
