<ul class="top-menu">
	<li class="<?=isCurrentRoute('home')?'current':''?>"><a href="<?=routeToUrl('home')?>">Dashboard</a></li>	
	<?php
		$files = getConf('files');
		foreach($files as $marker=>$fileInf):
			$routesToMatch = [
				'file/lines/'.$marker,
				'file/add/'.$marker,
				'file/edit/'.$marker,
			];
	?>
		<li class="<?=isCurrentRoute($routesToMatch)?'current':''?>">
			<a href="<?=routeToUrl('file/lines/'.$marker)?>"><?=$fileInf['menu']?></a>
		</li>
	<?php endforeach; ?>
	<li class="exit"><a href="<?=routeToUrl('login/logout')?>">Exit</a></li>		
</ul>
