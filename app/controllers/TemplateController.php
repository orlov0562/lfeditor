<?php

	abstract class TemplateController extends BaseController{
		protected $layout = 'layout';
		protected $body = '';
		protected $title = '';

		public function _before(){
			parent::_before();
			if (!isAllowedUserIp()) {
				redirectToRoute('denied');
			}
		}

		public function _after(){
			parent::_after();
			echo view($this->layout, [
				'title' => $this->title,
				'body' => $this->body,
			]);
		}

	}
