<?php

	class BackupController extends AdminController {
		public function indexAction(){
			if (getGetVar('do')) {
				foreach(getConf('files') as $fileInf) {
					copy($fileInf['path'], $fileInf['path'].'.bak');
				}
				addFlash('Backup created');
				redirectToRoute('backup');				
			}

			$this->title = 'Backup';
			
			$backups = [];

			foreach(getConf('files') as $fileInf) {
				if (file_exists($fileInf['path'].'.bak')) {
					$filename = $fileInf['path'].'.bak';
					$lines = count(file($fileInf['path'].'.bak'));
					$date = date('d.m.y H:i', filemtime($fileInf['path'].'.bak'));
					$backups[] = [
						'filename' => $filename,
						'lines' => $lines,
						'date' => $date,														
					];
				}

			}
			
			
			$this->body = view('backup/index',['backups'=>$backups]);
		}	
	}
