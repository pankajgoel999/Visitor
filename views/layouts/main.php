<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
<!--
                <div class="row">
                <div class="col-sm-6 col-12">
                    <div class="clock">
                        <div id="date-part"></div>
                    </div>
                </div>
                <div class="col-sm-6 col-12 text-right">
                    <div class="toprow">
                        <a href="#skip_content" title="Skip to main content">Skip to main content</a>
                        <a href="https://www.nvaccess.org/download/" class='externalLink' title="Screen Reader Access" target="_blank">Screen Reader Access</a>
                        <a href="javascript:void(0)" title="Background White" class="bgwhite">A</a>
                        <a href="javascript:void(0)" title="Background Black" class="bgblack">B</a>
                        <a href="javascript:void(0)" class="contrast bordernone borderleft" title="Decrease Font-size">A-</a>
                        <a href="javascript:void(0)" title="High Contrast Font" class="contrast bordernone contrastActive">A</a>
                        <a href="javascript:void(0)" title="Increase Font-size" class="contrast ">A+</a>
                        <a href="javascript:void(0)" title="Increase Font-size" onclick="changeLanguage('E')" class="contrast language">English</a>
                        <a href="javascript:void(0)" title="Increase Font-size" onclick="changeLanguage('P')" class="contrast language">ਪੰਜਾਬੀ</a>
                    </div>
                </div>
            </div>
-->
    <div id="header" class="container">
	<div id="logo">
        <img title="header" src="<?=Yii::$app->homeUrl?>images/header-removebg-preview.png" alt="" class="image image-left icons">
        
		<h1 class="deptname"><a href="#" >Haryana Police Visitor Management System</a></h1>
	</div>
        <?php
            $link1 = Yii::$app->homeUrl;
            $link2 = Yii::$app->homeUrl."site/contact";
        ?>
	<div id="menu">
		<ul>
			<li><a href="<?=$link1;?>" accesskey="1" title="">Home</a></li>
			<li><a href="<?=$link2;?>" accesskey="5" title="">Contact Us</a></li>
            
            <?php 
            if(!Yii::$app->user->isGuest) { ?>
            
            
                <li>
                    <form action="<?=Yii::$app->homeUrl?>site/logout" method="post">
                        <input name="_csrf" value="<?=@Yii::$app->request->csrfToken; ?>" type="hidden">
                        <button style="background:none; padding: 0px;" type="submit" class="btn logout"><b>Logout</b> </button>
                    </form>
                </li>
             <?php } else {
            }
               ?>
            
            
            
            
		</ul>
	</div>
</div>
<div class="line"></div>
    
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        
        <?= $content ?>
    
</div>

<div id="copyright">
 
	
	<p>&copy; All rights reserved. | Designed and Developed by CDAC</p>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
