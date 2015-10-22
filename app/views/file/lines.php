<h1>File "<?=esc($fileInf['menu'])?>" lines</h1>

<a href="<?=routeToUrl('file/add/'.$fileMarker,['p'=>$p])?>" class="btn">Add line</a>
<a href="" class="btn">Refresh</a>
<br><br>

<?php if ($messages = getFlashes('msg')):?>
<?=view('blocks/messages',['messages'=>$messages])?>
<br><br>
<?php endif;?>

<table class="colored">
<tr>
	<th class="id">Line</th>
	<th class="contents">Contents</th>
	<th class="manage">Manage</th>	
</tr>	

<?php foreach($lines as $id=>$line):?>
<tr>
	<td class="id"><?=$id?></td>
	<td class="contents"><?php
		$line = esc($line);
		if (mb_strlen($line) < 125) {
			echo $line;
		} else {
			echo '<span title="'.$line.'">';
			echo mb_substr($line, 0, 125).'..';
			echo '</span>';
		}
	?></td>
	<td class="manage">
		<a href="<?=routeToUrl('file/edit/'.$fileMarker.'/'.$id, ['p'=>$p])?>" class="btn">Edit</a>
		<a href="<?=routeToUrl('file/delete/'.$fileMarker.'/'.$id, ['p'=>$p])?>" class="btn" onclick="if (!confirm('Delete line id: <?=$id?>?')) return false;">Delete</a>		
	</td>	
</tr>	
<?php endforeach;?>
</table>

<?=isset($pagination) ? $pagination : '' ?>
