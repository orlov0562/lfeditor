<?php

	abstract class AdminController extends TemplateController {
		public function _before(){
			parent::_before();
			if (!isAuthenticatedUser()) {
				$request = getConf('_request');
				setSessionVar('ret', $request['alias']);				
				redirectToRoute('login');
			}
		}
	}
