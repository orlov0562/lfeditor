<!doctype html>
<html>

<head>
	<title><?=isset($title)?esc($title):''?></title>
	<link rel="stylesheet" href="<?=getMediaUrl('css/style.css')?>">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
</head>

<body>
	<?=view('menu')?>
	<?=isset($body)?$body:''?>
</body>

</html>
