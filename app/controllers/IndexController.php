<?php

	class IndexController extends AdminController {

		public function indexAction(){
			$this->title = 'Dashboard';
			$this->body = view('home/dashboard');
		}
		
		public function testAction(){
			$this->title = 'Test';		
			$this->body = 'Test action';
		}		
	}
