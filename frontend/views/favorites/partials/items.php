<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php foreach($models as $model):?>
	<?php $url = Url::toRoute(['property/view', 'slug' => $model->slug, 'state' => $model->state, 'city' => $model->city]);?>
	<div class="my-favorites__item row bg-white m-0 position-relative box" data-id="<?=$model->id;?>">

		<div class="col-12 col-md-5">
			<a role="button" class="add-to-favorite-btn position-absolute top-30 start-30 bg-white actions__toggle js_property_likes trans-all" data-id="<?=$model->id;?>">
				<input type="checkbox" <?=($model->Liked ? 'checked="checked"' : '');?> class="js_trigger" data-property_id="<?=$model->id;?>" data-trigger="js_action_change" data-action="property_toggle_favorite">
				<i class="bi bi-heart text-color-primary uncheck"></i>
				<i class="bi bi-heart-fill text-color-primary check"></i>
				<span class="count d-none"><?=$model->likes;?></span>
			</a>
			<a href="<?=$url;?>">
				<?=Yii::$app->Helpers->getImage([
					'src' => $model->getMainImage('250'),
					'data-srcset' => $model->getMainImage('575').' 575w, '.$model->getMainImage('767').' 767w, '.$model->getMainImage('250').' 768w',
					'data-sizes' => '250w',
					'alt' => $model->title,
					'from_cdn' => false,
					'lazyload' => true,
					'class' => 'my-favorites__img mb-2 mb-xxl-0 img-fluid',
				]);?>
			</a>
		</div>

		<div class="col-12 col-md-7">
			<h2 class="my-favorites__item-title mb-1"><a href="<?=$url;?>"><?=$model->title;?></a></h2>
			<div class="address mb-15">
				<i class="bi bi-geo-alt me-1"></i>
				<span class="similar-offers__adress"><?=$model->address;?></span>
			</div>

			<?php if($options['display_desc']):?>
			<p class="my-favorites__item-text mb-2 d-none d-md-block"><?=Yii::$app->Helpers->createExcerpt($model->description, $options['desc_length']);?></p>
			<?php endif;?>
			
			<?php if($options['add_to_compare']):?>
				<a role="button" class="compare__toggle position-relative d-block bg-white trans-all">
					<?=Html::checkbox('add_to_compare', false, ['id' => 'compare_'.$model->id, 'data-id' => $model->id, 'data-slug' => $model->slug, 'data-trigger' => 'js_action_change', 'data-action' => 'add_to_compare']);?>
					<i class="bi bi-check-square-fill check"></i>
					<i class="bi bi-check-square uncheck"></i>
					<label for="compare_<?=$model->id;?>">Add to comparison</label>
				</a>
			<?php endif;?>
		</div>
	</div>
<?php endforeach;?>
