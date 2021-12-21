<?php

use yii\helpers\Url;
use frontend\widgets\UserFavorites;
?>

<div class="header-logo"><a class="" href="<?=Url::toRoute('/')?>"><?=Yii::$app->params['settings']['site_title'];?></a></div>
<div class="flex-grow-1 d-md-block navigation trans-all">
	<a role="button" class="nav-control close d-flex d-md-none flex-row flex-nowrap justify-content-between" data-trigger="js_action_click" data-action="toggle_mobile_nav" data-target=".navigation">
		<span class="header-logo"><?=Yii::$app->params['settings']['site_title'];?></span>
		<i class="zmdi zmdi-long-arrow-right"></i>
	</a>
	<nav>
		<ul class="d-block d-md-flex align-items-center justify-content-center mb-0 p-0">
			<li><a href="<?=Url::toRoute('/')?>" class="active">Home</a></li>
			<li><a href="#">Our policies</a></li>
			<li><a href="#">Learn & Plans</a></li>
			<li><a href="#">Why GeorgiaCaring</a></li>
		</ul>
	</nav>
</div>
<div class="d-none d-md-block"><a href="tel:11234567890" class="header-home__tel text-decoration-none"><i class="zmdi zmdi-phone me-1"></i>1-123-456-7890</a></div>
<div class="d-flex d-md-none align-items-center">
	<a role="button" class="header-home__favorite-box d-flex align-items-center justify-content-center me-1 text-decoration-none"><i class="bi bi-heart-fill text-color-primary me-1"></i> My Favorites</a>
	<a role="button" class="nav-control" data-trigger="js_action_click" data-action="toggle_mobile_nav" data-target=".navigation"><i class="zmdi zmdi-menu"></i></a>
</div>
