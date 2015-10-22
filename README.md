# lfeditor
Backend that allows edit text files line-by-line.

I'm using it to edit through browser filters files that contains stop-words.

For example, if I have files with next contents:

```text
stopword-1
stopword-2
stopword-3
```

The script represent this file in GUI in next way:

```text
[File-1]  [File-2]   [File-3]
----------------------------------------------

[ add new line]

stopword-1 [ edit ] [ delete ]
stopword-2 [ edit ] [ delete ]
stopword-3 [ edit ] [ delete ]

[1] [2] [3] .. [55]
```

so I can edit it in fast way.

##Configuration

1) Clone project with git

2) Copy app/config.php.example to app/config.php

3) Open app/config.php and replace admin password in next section:

```php
setConf('admin.password', 'YOUR-PASSWORD');
```

4) Open main page and take a fun with Test file :)

5) Add your files to config, ex:

```php
	setConf('files', [
		'marker-1'=>[
			'menu' => 'Menu Title 1',
			'path' => '/path/to/your/file-1',
		],		
		'marker-2'=>[
			'menu' => 'Menu Title 2',
			'path' => '/path/to/your/file-2',
		],		
	]);
```

6) If you want to turn on pretty urls do next:

 a) rename `.htaccess.example` to `.htaccess` . Modify RewriteBase if needed (if you use subfolder).

 b) change `setConf('url.rewrite', false);` to `setConf('url.rewrite', true);` in config file

7) Enjoy :]

##FAQ

What is default password? 
- admin
