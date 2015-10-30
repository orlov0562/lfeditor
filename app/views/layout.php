<!doctype html>
<html>

<head>
	<title><?=isset($title)?esc($title):''?></title>
	<link rel="stylesheet" href="<?=getMediaUrl('css/style.css')?>">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
</head>

<body>
	<div class="header">
		<div class="project-name"><h1><a href="<?=routeToUrl('home')?>"><?=getConf('project.name')?></a></h1></div>
		<div class="menu"><?=view('menu')?></div>
	</div>
	<div class="body">
		<?=isset($body)?$body:''?>
	</div>
</body>

</html>
