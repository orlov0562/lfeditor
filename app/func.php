<?php

	function getConf($var, $def = null) {
		if (isset($GLOBALS['__cfg'][$var]))
		{
			return $GLOBALS['__cfg'][$var];
		} else {
			return $def;
		}
	}

	function setConf($var, $val) {
		$GLOBALS['__cfg'][$var] = $val;
	}

	function processRoute($route)
	{
		$controllerName = $route['controller'];
		$controllerName = strtolower($controllerName);
		$controllerName = ucfirst($controllerName);
		$controllerName .= 'Controller';

		if (!class_exists($controllerName)) {
			if (isEnvMode('dev')) {
				throw new Exception('Undefined controller '.$controllerName);
			} else {
				redirectTo404();
			}
		}

		$controllerObj = new $controllerName;

		$actionName = $route['action'];
		$actionName = strtolower($actionName);
		$actionName = ucfirst($actionName);
		$actionName .= 'Action';

		if (!method_exists($controllerObj, $actionName)) {
			if (isEnvMode('dev')) {
				throw new Exception('Undefined action '.$controllerName.'::'.$actionName);
			} else {
				redirectTo404();
			}
		}

		if (method_exists($controllerObj, '_before')) {
			call_user_func([$controllerObj, '_before']);
		}

		call_user_func_array([$controllerObj, $actionName], $route['params']);

		if (method_exists($controllerObj, '_after')) {
			call_user_func([$controllerObj, '_after']);
		}
	}

	function redirectToRoute($route, array $getVars=[], $code=302) {
		redirect(routeToUrl($route, $getVars), $code);
	}

	function redirectTo404() {
		$request = getConf('_request');
		if ($request['plain'] != getRouteFromAlias('404')) {
			redirectToRoute('404');
		} else { // "Not found" route not found :), avoid loop redirection
			die('404 - Not found');
		}
	}

	function redirect($url, $code=302) {
		Header('Location:'.$url, TRUE, $code);
		exit;
	}

	function routeToUrl($route, array $getVars=[])
	{
		$request = getConf('_request');

		$url = $request['baseUrl'];

		if (getConf('url.rewrite')) {
			$url.='/'.$route;
		} else {
			$getVars['r'] = $route;
		}

		if ($getVars) {
			$url.='/?'.http_build_query($getVars);
		}

		return $url;
	}

    function getBaseUrl() {
        // output: /myproject/index.php
        $currentPath = $_SERVER['PHP_SELF'];
        // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index )
        $pathInfo = pathinfo($currentPath);
        // output: localhost
        $hostName = $_SERVER['HTTP_HOST'];
        // output: http://
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        // return: http://localhost/myproject/
        return $protocol.$hostName.$pathInfo['dirname'];
    }

    function getMediaUrl($urlPart){
    	return getBaseUrl().'/media/'.$urlPart;
    }

	function isEnvMode($mode) {
		return getConf('env') == $mode;
	}

	function getRequestVar($index, $def=null) {
		return getArrVar($_REQUEST, $index, $def);
	}

	function getGetVar($index, $def=null) {
		return getArrVar($_GET, $index, $def);
	}

	function getPostVar($index, $def=null) {
		return getArrVar($_POST, $index, $def);
	}

	function getCookieVar($index, $def=null) {
		return getArrVar($_COOKIE, $index, $def);
	}

	function setCookieVar($index, $val, $period=86400, $path='/') {
		setcookie($index, $val, time() + $period, $path);
	}

	function getSessionVar($index, $def=null) {
		return getArrVar($_SESSION, $index, $def);
	}

	function setSessionVar($index, $val) {
		$_SESSION[$index] = $val;
	}

	function getArrVar(array $arr, $index, $def=null) {
		return !empty($arr[$index])
			   ? $arr[$index]
			   : $def
		;
	}

	function esc($text){
		return htmlspecialchars($text, ENT_QUOTES);
	}

	function isAuthenticatedUser(){
		return getSessionVar('auth_key') == 'allowed';
	}

	function isAllowedUserIp() {
		return !getConf('admin.ip') OR (getConf('admin.ip')==$_SERVER['REMOTE_ADDR']);
	}

	function getRouteFromAlias($alias){
		return getArrVar(getConf('route.aliases'), $alias, $alias);
	}

	function view($template, array $vars=[]) {
		$templatePath = ROOT_DIR.'/app/views/'.$template.'.php';
		if (!file_exists($templatePath)) {
			throw new Exception('Template file "'.$templatePath.'" not found');
		}
		ob_start();
		extract($vars);
		include $templatePath;
		$html = ob_get_clean();
		return $html;
	}

	function isCurrentRoute($aliases) {
		$ret = false;
		$request = getConf('_request');

		if (!is_array($aliases)) $aliases = [$aliases];

		foreach($aliases as $alias) {
			$route = getRouteFromAlias($alias);
			$ret = $request['plain'] == $route;
			if ($ret) break;
		}

		return $ret;
	}

	function addFlash($msg, $type='msg') {
		$fm = getSessionVar('_flash_messages',[]);
		if (!isset($fm[$type])) $fm[$type] = [];
		$fm[$type][] = $msg;
		setSessionVar('_flash_messages', $fm);
	}

	function addFlashes($msgs, $type='msg') {
		foreach($msgs as $msg) addFlash($msg, $type);
	}

	function getFlashes($type=null){
		$ret = [];
		$fm = getSessionVar('_flash_messages',[]);
		if (is_null($type)) {
			$ret = $fm;
			setSessionVar('_flash_messages',[]);
		} else {
			$ret = getArrVar($fm, $type, []);
			if ($ret) {
				unset($fm[$type]);
				setSessionVar('_flash_messages', $fm);
			}
		}
		return $ret;
	}


