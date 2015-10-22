<h1>Add new line to file "<?=esc($fileInf['menu'])?>"</h1>

<a href="<?=routeToUrl('file/lines/'.$fileMarker,['p'=>$p])?>" class="btn">Back</a>

<br><br>

<form method="post">
Line contents:<br/>
<input type="text" name="form[newLine]" style="width:500px;" value="<?=isset($form['newLine'])?esc($form['newLine']):''?>">
<input type="submit" name="form[submit]" value="Add">
</form>

<?php if ($messages = getFlashes('err')):?>
	<?=view('blocks/errors',['messages'=>$messages])?>
<?php endif;?>

