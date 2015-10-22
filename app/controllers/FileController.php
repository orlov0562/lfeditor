<?php

	class FileController extends AdminController {
		
		public function linesAction($fileMarker){
			$this->title = 'File "'.esc($fileMarker).'" lines';
			
			if (!$fileInf = getArrVar(getConf('files'), $fileMarker) or !file_exists($fileInf['path'])) {
				throw new Exception('File with marker '.$fileMarker.' not found');
			}

			$perPage = getConf('per.page');
			$page = getGetVar('p', 0);

			$posFrom = $page * $perPage;
			$posFrom = $page * $perPage;			
			$posTo = $page * $perPage + $perPage;

			
			$allLines = array_reverse(file($fileInf['path']), TRUE);
			$linesTotal = count($allLines);
			$linesToShow = array_slice($allLines, $posFrom, $perPage, TRUE);

			$pagesTotal = ceil($linesTotal/$perPage);
			
			$this->body = view('file/lines', [
				'fileMarker' => $fileMarker,
				'fileInf' => $fileInf,				
				'lines' => $linesToShow,
				'p' => $page,
				'pagination' => view('blocks/pagination',[
					'current' => $page,
					'total' => $pagesTotal,
					'baseRoute' => 'file/lines/'.$fileMarker
				]),
			]);
		}
		
		public function addAction($fileMarker){

			$errors = [];

			$this->title = 'Add new line to file "'.esc($fileMarker).'"';
			
			if (!$fileInf = getArrVar(getConf('files'), $fileMarker) or !file_exists($fileInf['path'])) {
				throw new Exception('File with marker '.$fileMarker.' not found');
			}

			$form = getPostVar('form');
			if (!empty($form))
			{
				if (empty($form['newLine']) || !trim($form['newLine'])) {
					$errors[]='Line contents should be filled';
				}
				
				if (!$errors && getConf('check.new.lines.for.unique')) {
					$data = file($fileInf['path']);
					$ignoreCase = getConf('check.new.lines.ignore.case');
					$checkLine = trim($form['newLine']);
					if ($ignoreCase) $checkLine = strtolower($checkLine);
					foreach ($data as $line) {
						$line = trim($line);
						if ($ignoreCase) $line = strtolower($line);

						if ($line == $checkLine ) {
							$errors[] = 'This line already exists in the file';
							break;
						}
					}
				}

				if (!$errors) {
					addFlash('Message added');
					file_put_contents($fileInf['path'], trim($form['newLine']).PHP_EOL, FILE_APPEND);
					redirectToRoute('file/lines/'.$fileMarker);
				}
			}

			addFlashes($errors, 'err');

			$this->body = view('file/add',[
				'form' => $form,
				'fileMarker' => $fileMarker,
				'fileInf' => $fileInf,
				'p' => getGetVar('p', 0),
			]);
		}
		
		public function editAction($fileMarker, $lineNum){

			$errors = [];

			$this->title = 'Edit line into file "'.esc($fileMarker).'"';
			
			if (!$fileInf = getArrVar(getConf('files'), $fileMarker) or !file_exists($fileInf['path'])) {
				throw new Exception('File with marker '.$fileMarker.' not found');
			}
			
			$data = file($fileInf['path']);

			if (!isset($data[$lineNum])) {
				throw new Exception('Line '.$line.' not found in file '.$fileMarker);
			}
			
			$page = getGetVar('p', 0);
			
			$form = getPostVar('form');
			if (!empty($form))
			{
				if (empty($form['editLine']) || !trim($form['editLine'])) {
					$errors[]='Line contents should be filled';
				}
				
				if (!$errors && getConf('check.new.lines.for.unique')) {
					$ignoreCase = getConf('check.new.lines.ignore.case');
					$checkLine = trim($form['editLine']);
					if ($ignoreCase) $checkLine = strtolower($checkLine);
					foreach ($data as $ln=>$line) {
						if ($ln==$line) continue; // skip line that we are edit
						$line = trim($line);
						if ($ignoreCase) $line = strtolower($line);

						if ($line == $checkLine ) {
							$errors[] = 'This line already exists in the file';
							break;
						}
					}
				}

				if (!$errors) {
					addFlash('Message added');
					$data[$lineNum] = trim($form['editLine']).PHP_EOL;
					file_put_contents($fileInf['path'], implode($data));
					redirectToRoute('file/lines/'.$fileMarker,['p'=>$page]);
				}
			} else {
				$form['editLine'] = $data[$lineNum];
			}

			addFlashes($errors, 'err');

			$this->body = view('file/edit',[
				'form' => $form,
				'fileMarker' => $fileMarker,
				'fileInf' => $fileInf,
				'p' => $page,
			]);
		}		
		
		public function deleteAction($fileMarker, $line){
		
			if (!$fileInf = getArrVar(getConf('files'), $fileMarker) or !file_exists($fileInf['path'])) {
				throw new Exception('File with marker '.$fileMarker.' not found');
			}
			
			$data = file($fileInf['path']);
			if (isset($data[$line])) unset($data[$line]);
			file_put_contents($fileInf['path'], implode($data));

			$p = getGetVar('p', 0);
			$lastPage = ceil(count($data)/getConf('per.page'))-1;
			if ($lastPage>0 && $p>$lastPage) $p = $lastPage;
			
			redirectToRoute('file/lines/'.$fileMarker,['p'=>$p]);
		}		
		
	}
