<?php

	class ErrorsController extends BaseController {

		protected $layout = 'layout-guest';
		protected $body = '';
		protected $title = '';


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

		public function _after(){
			parent::_after();
			echo view($this->layout, [
				'title' => $this->title,
				'body' => $this->body,
			]);
		}

	}
