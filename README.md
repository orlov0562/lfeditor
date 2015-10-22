# lfeditor
Backend that allows edit text files line-by-line.

I'm using it to edit through browser filters files that contains stop-words.

For example, if I have files with next contents:
```
stopword-1
stopword-2
stopword-3
```
this script represent it in GUI in next way:
```
[File-1]  [File-2]   [File-3]
----------------------------------------------

[ add new line]

stopword-1 [ edit ] [ delete ]
stopword-2 [ edit ] [ delete ]
stopword-3 [ edit ] [ delete ]

[1] [2] [3] .. [55]
```
so I can edit this files in fast way.

Configuration
~~~~~~~~~~~~~~
1) Clone project with git
2) Open app/config.php and replace admin password in next section:
```
setConf('admin.password', 'YOUR-PASSWORD');
```
3) Open main page and take a fun with Test file :)
4) Add your files to config, ex:
```
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
5) Enjoy :)

FAQ
~~~~~~~~~~~~~~
What is default password?
- admin
