<h1>File editor</h1>

<a href="?do=backup" class="btn">Create backup</a>
<br><br>

<?php if ($messages = getFlashes('msg')):?>
<?=view('blocks/messages',['messages'=>$messages])?>
<br><br>
<?php endif;?>

<strong>Backups list</strong>
<?php if (!empty($backups)): ?>
	<table class="colored">
	<tr>
		<th>Filename</th>
		<th>Date</th>
		<th>Lines cnt</th>	
	</tr>	

	<?php foreach($backups as $backup):?>
	<tr>
		<td><?=$backup['filename']?></td>
		<td><?=$backup['date']?></td>	
		<td><?=$backup['lines']?></td>	
	</tr>	
	<?php endforeach;?>
	</table>
<?php else: ?>
<p>No backups found</p>
<?php endif; ?>
