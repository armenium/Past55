<?php

/* @var $this yii\web\View */

use \yii\web\Request;

$this->title = 'Admin Dashboard';
$baseUrl = str_replace('/backend/web', '', (new Request)->getBaseUrl());
Yii::setAlias('@front',$baseUrl. '/frontend/web');
$front  = Yii::getAlias('@front');

?>
<style>
    .chart_wrapper
    {
        width: 100%;
        height: 360px;
        min-height: 350px;
        background-color: #fff;
        padding: 7px;

    }
    .chart_wrapper > div
    {
        vertical-align: bottom;
        width: 50px;
        bottom: 0px;
        position: relative;
        background-color: #eee;
        display: inline-block;
        text-align: center;
        color: #fff;
        min-height: 10px;
        margin: 3px;
    }
    .chart_wrapper2
    {
        width: 100%;
        height: 90px;
        min-height: 90px;
        background-color: #fff;
        padding: 7px;

    }
    .chart_wrapper2 > div
    {
        display: inline-block;
        vertical-align: bottom;
        width: 50px;
        height: 50px;
        bottom: 0px;
        position: relative;
        background-color: #fff;
        display: inline-block;
        text-align: center;
        color: #000;
        min-height: 10px;
        margin: 3px;
    }
    .rotet {
        /*-webkit-transform: rotate(90deg);*/
        /*transform: rotate(90deg);*/
        bottom: 32px;
        position: absolute;
        color: #000;
        font-size: 9px;
        font-weight: lighter;
    }
</style>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?= $total ?></h3>
                <p>Total properties</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?= $active ?><sup style="font-size: 20px">%</sup></h3>
                <p>Active property</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?= $pending ?></h3>
                <p>Pending property</p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-speedometer-outline"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?= $totalUser; ?></h3>
                <p>User Registrations</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
</div><!-- /.row -->

<!-- Main row -->
<div class="row">
    <div class=" col-lg-12">

        <div class="chart_wrapper">
            <h4>
                Category wise property Listing
            </h4>
            <div style="background-color: #fff;color: #777">
                <table style="height: 360px;">
                    <tr>
                        <td>10</td>
                    </tr>
                    <tr>
                        <td>9</td>
                    </tr>
                    <tr>
                        <td>8</td>
                    </tr>
                    <tr>
                        <td>7</td>
                    </tr>
                    <tr>
                        <td>6</td>
                    </tr>
                    <tr>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>4</td>
                    </tr>
                    <tr>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>0</td>
                    </tr>

                </table>
            </div>
            <?php
            $count = \common\models\Property::find()->count();
            $cat = \common\models\Category::find()->limit(15)->all();
            foreach($cat as $data)
            {
                $ads_count = \common\models\Property::find()->where(['category_id'=>$data['id']])->count();;

                if($ads_count > '0')
                {
                    $a = $ads_count/$count;
                    $b = $a*100;
                    $c = $b*3.6;
                }
                else
                {
                    $c = $ads_count*3.6;
                }


                if($c > 0)
                {
                    echo  '<div style="height: '.$c.'px;background-color:#ff7f2e"></div>';
                }
                else
                {
                    echo  '<div style="height: '.$c.'px;background-color:#ff7f2e"></div>';
                }
            };


            ?>

        </div>
        <div class="chart_wrapper2 col-lg-12">
            <div style="background-color: #fff;color: #777">
                <table style="height: 30px;">
                    <tr>
                        <td>&nbsp;</td>
                    </tr>

                </table>
            </div>
            <?php
            foreach($cat as $data)
            {
                $ads_count = \common\models\Property::find()->where(['category_id'=>$data['id']])->count();;

                if($ads_count > '0')
                {
                    $a = $ads_count/$count;
                    $b = $a*100;
                    $c = $b*3.6;
                }
                else
                {
                    $c = $ads_count*3.6;
                }


                if($c > 0)
                {
                    echo  '<div class="rotet"><span>'.$data['name'].' ('.$ads_count.')</span></div>';
                }
                else
                {
                    echo  '<div class="rotet"><span>'.$data['name'].' ('.$ads_count.')</span></div>';
                }
            }
            ?>
        </div>
    </div>
    <div style="margin-bottom: 20px;display: block">&nbsp;</div>
</div>
<div class="row">
    <!-- Left col -->
    <div class="col-md-8">
        <!-- MAP & BOX PANE -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Visitors Report</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body no-padding">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table">
                            <tr>
                                <th>Visitor Agent</th>
                                <th>Visitor Browser</th>
                                <th>Visitor System</th>
                                <th>Visitor iP</th>
                                <th>Visitor City / Country</th>
                                <th>Refer Url</th>
                                <th>Page View</th>

                            </tr>
                            <?php
                            foreach($statistics as $list)
                            {
                                ?>
                                <tr>

                                    <td><?= \common\models\Track::ExactOs($list['agent']) ; ?></td>
                                    <td><?= \common\models\Track::ExactBrowserName($list['agent']) ; ?></td>
                                    <td> <?= $list['system']; ?></td>
                                    <td> <?= $list['ip']; ?></td>
                                    <td><?= $list['city']; ?> - <?= $list['country']; ?></td>
                                    <td>
                                        <a target="_blank" href="<?= $list['ref']; ?>">
                                            <?= $list['ref']; ?>
                                        </a>
                                    </td>
                                    <td> <?= $list['page_view']; ?></td>
                                </tr>
                                <?php

                            }
                            ?>
                        </table>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.box-body -->
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <a href="<?= \yii\helpers\Url::toRoute('statics/index') ?>" class="btn btn-sm btn-info btn-flat pull-left">View All</a>
            </div><!-- /.box-footer -->
        </div><!-- /.box -->


        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Latest property</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Type</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($property as $adsList)
                        {
                            ?>
                            <tr>
                                <td><a href="pages/examples/invoice.html"><?= $adsList['id'] ?></a></td>
                                <td><?= $adsList['title'] ?></td>
                                <td><span class="label label-success"><?= $adsList['price'] ?></span></td>
                                <td><div class="sparkbar" data-color="#00a65a" data-height="20"><?= $adsList['list_for'] ?></div></td>
                            </tr>

                            <?php
                        }
                        ?>

                        </tbody>
                    </table>
                </div><!-- /.table-responsive -->
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                <a href="<?= \yii\helpers\Url::toRoute('property/index') ?>" class="btn btn-sm btn-info btn-flat pull-left">View All properties</a>
            </div><!-- /.box-footer -->
        </div><!-- /.box -->
    </div><!-- /.col -->

    <div class="col-md-4">
        <!-- Info Boxes Style 2 -->
        <div class="info-box bg-yellow hidden">
            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Inventory</span>
                <span class="info-box-number">5,200</span>
                <div class="progress">
                    <div class="progress-bar" style="width: 50%"></div>
                </div>
                <span class="progress-description">
                    50% Increase in 30 Days
                  </span>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
        <div class="info-box bg-green hidden">
            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Mentions</span>
                <span class="info-box-number">92,050</span>
                <div class="progress">
                    <div class="progress-bar" style="width: 20%"></div>
                </div>
                <span class="progress-description">
                    20% Increase in 30 Days
                  </span>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->

        <div class="info-box bg-aqua hidden">
            <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Direct Messages</span>
                <span class="info-box-number">163,921</span>
                <div class="progress">
                    <div class="progress-bar" style="width: 40%"></div>
                </div>
                <span class="progress-description">
                    40% Increase in 30 Days
                  </span>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->

        <!-- USERS LIST -->
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Latest Members</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body no-padding">
                <ul class="users-list clearfix">
                    <?php
                    foreach($member as $user)
                    {
                        ?>
                        <li>
                            <img src="<?= Yii::$app->urlManagerFrontend->baseUrl.'/images/user/'.$user['image'] ?>" class="img-thumbnail">

                            <a class="users-list-name" href="<?= \yii\helpers\Url::toRoute('site/user') ?>?id=<?= $user['id'] ?>"><?= $user['username'] ?></a>
                            <span class="users-list-date">
                                <?= date('d/m/Y',$user['created_at']); ?>
                            </span>
                        </li>
                        <?php
                    }
                    ?>


                </ul><!-- /.users-list -->
            </div><!-- /.box-body -->
            <div class="box-footer text-center">
                <a href="<?= \yii\helpers\Url::toRoute('statics/index') ?>" class="uppercase">View All Users</a>
            </div><!-- /.box-footer -->
        </div><!--/.box -->

        <!-- PRODUCT LIST -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Recently Added Products</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <ul class="products-list product-list-in-box">
                    <?php
                    foreach($property as $adsList)
                    {
                        $imagebase = $adsList['image'];
                        $imageArray = explode(",",$imagebase);
                        $img = reset($imageArray);
                        ?>
                        <li class="item">
                            <div class="product-img">

                                <img src="<?= Yii::$app->urlManagerFrontend->baseUrl.'/images/property/'.$adsList['id'].'/thumbs/'.$img?>" class="img-thumbnail">
                            </div>
                            <div class="product-info">
                                <a href="javascript::;" class="product-title"><?= $adsList['sub_category'] ?><span class="label label-warning pull-right">$<?= $adsList['price'] ?></span></a>
                                <span class="product-description">
                          <?= $adsList['title'] ?>
                        </span>
                            </div>
                        </li><!-- /.item -->



                        <?php
                    }
                    ?>

                </ul>
            </div><!-- /.box-body -->
            <div class="box-footer text-center">
                <a href="<?= \yii\helpers\Url::toRoute('property/index') ?>" class="uppercase">View All Products</a>
            </div><!-- /.box-footer -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div>