<ul class="pagination">
	<?php 
		$showFromSide = 4;
		for($p=0; $p<$total; $p++) {

			if ($p>($current+$showFromSide) && $p<($total-$showFromSide-1)) {
				if ($p==($current+$showFromSide+1)) echo '<li><span>..</span></li>';
				continue;
			}
			
			if ($p>$showFromSide && $p<($current-$showFromSide)) {
				if ($p==($showFromSide+1)) echo '<li><span>..</span></li>';
				continue;
			}			

			echo '<li'.($p==$current?' class="current"':'').'>';	
			echo '<a href="'.routeToUrl($baseRoute,['p'=>$p]).'">'.($p+1).'</a>';
			echo '</li>';
		}
	?>
</ul>

