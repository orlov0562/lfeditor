<h1>Edit line into file "<?=esc($fileInf['menu'])?>"</h1>

<a href="<?=routeToUrl('file/lines/'.$fileMarker,['p'=>$p])?>" class="btn">Back</a>

<br><br>

<form method="post">
Line contents:<br/>
<input type="text" name="form[editLine]" style="width:500px;" value="<?=esc($form['editLine'])?>">
<input type="submit" name="form[submit]" value="Save">
</form>

<?php if ($messages = getFlashes('err')):?>
	<?=view('blocks/errors',['messages'=>$messages])?>
<?php endif;?>

