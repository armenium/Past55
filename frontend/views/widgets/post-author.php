<div <?=$wrapper_attrs;?>>
	<?=$avatar;?>
	<div class="name"><?=$name;?></div>
	<div class="position mb-15"><?=$position;?></div>
	<p class="about mb-15"><?=$about;?></p>
	<?php if(!empty($social_links)):?>
	<div class="d-flex flex-wrap">
		<?php foreach($social_links as $name => $link):?>
			<a href="<?=$link;?>" target="_blank" class="social-icon d-flex align-items-center justify-content-center rounded-circle m-1"><i class="zmdi zmdi-<?=$name;?>"></i></a>
		<?php endforeach;?>
	</div>
	<?php endif;?>
</div>
