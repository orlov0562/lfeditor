<?php

	class ErrorsController extends TemplateController {

		protected $layout = 'layout-guest';

		public function err404Action(){
			$this->title = 'Error 404';
			$this->body = view('errors/404');
		}

		public function err503Action(){
			$this->title = 'Error 503';
			$this->body = view('errors/503');
		}

		public function deniedAction(){
			$this->title = 'Access denied';
			$this->body = view('errors/denied');
		}
	}
