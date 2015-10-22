<?php

	class LoginController extends TemplateController {
		protected $layout = 'layout-guest';

		public function formAction(){
			$this->title = 'Login';
			$this->body = view('login/form');			
		}
		
		public function loginAction(){
			$pass = getPostVar('pass');
			if ($pass == getConf('admin.password'))
			{
				setSessionVar('auth_key', 'allowed');
				$redirectRoute = getCookieVar('ret', getRouteFromAlias('home'));
				setSessionVar('ret', '');
				redirectToRoute($redirectRoute);
			} else {
				$this->title = 'Login error';
				$this->body = view('login/login-err');
			}
		}
	
		public function logoutAction(){
			setSessionVar('auth_key', '');
			redirectToRoute('home');
		}		
	}
