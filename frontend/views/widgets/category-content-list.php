<?php

use yii\helpers\Url;
use yii\helpers\VarDumper;

#VarDumper::dump($model, 10, 1);

if(!$found) return '';
?>
<?php if(!empty($title)):?>
	<h4 class="content-title"><?=$title;?></h4>
<?php endif;?>
<ul class="content-list">
	<?php foreach($model as $item):?>
		<li><a href="<?=Url::toRoute(['post/view', 'post_slug' => $item->slug, 'category_slug' => $category_slug]);?>"><?=(!empty($item->ccl_title) ? $item->ccl_title : $item->title);?></a></li>
	<?php endforeach;?>
</ul>
