<?php if (!empty($messages)):?>
	<ul class="messages">
		<?php foreach($messages as $message):?>
			<li><?=esc($message)?></li>
		<?php endforeach?>
	</ul>
<?php endif;?>
