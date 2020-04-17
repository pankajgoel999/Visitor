<?php
use app\widgets\Alert;
use yii\helpers\Html;

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
	<link href="<?=Yii::$app->homeUrl?>css/admin.css" rel="stylesheet" id="bootstrap-css">

</head>
<body>
<?php $this->beginBody()  ?>
		
<!------ Include the above in your HEAD tag ---------->

<body>
  
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
     <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav">

          <a class="nav-link navlogo text-center" href="<?php  Yii::$app->homeUrl?>">
            <img src="<?=Yii::$app->homeUrl?>images/header-removebg-preview.png">
          </a>

        
		<?php
		$leftMenus = Yii::$app->Boutility->backoffice_left_menu();
		if(!empty($leftMenus))
		{
            foreach($leftMenus as $l)
			{
                $leftmenuid = Yii::$app->Boutility->encryptString($l['menuid']);
                $topmenuid = Yii::$app->Boutility->encryptString($l['parent']);
                $menu_name = $l['menu_name'];
                $menu_url = Yii::$app->homeURL.$l['menu_url']."?securekey=$leftmenuid&securekey1=$topmenuid";
                $active = "";

                if(Yii::$app->language == 'hi'){
                    if(empty($l['menu_name_ll'])){
                        $menu_name = $l['menu_name'];
                    }else{
                        $menu_name = $l['menu_name_ll'];
                    }
                }
                echo "<li class='nav-item'><a class='nav-link' href='$menu_url'><span class='textside'>$menu_name</span></a></li>";
            }
        }
		?>
      </ul>
      <div class="text-right"><ul class="navbar-nav2 ml-auto">
		<?php
		$loginuser="";
		if(isset(Yii::$app->user->identity) && !empty(Yii::$app->user->identity))
		{
			$loginuser=ucfirst(Yii::$app->user->identity->username); 
		}
		?>
		<?php if(!Yii::$app->user->isGuest) { ?>
			<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" >Welcome <?=$loginuser?></a>
            <ul class="dropdown-menu">
                <li class="resflset">Edit profile</li>
                <li class="divider"></li>
                <li class="resflset"> 
					<form action="<?=Yii::$app->homeUrl?>site/logout" method="post">
                        <input name="_csrf" value="<?=@Yii::$app->request->csrfToken; ?>" type="hidden">
                        <button style="background:none; padding: 0px;" type="submit" class="btn logout"><b>Logout</b> </button>
                    </form>
				</li>
            </ul>
			</li>
		<?php } 
		else 
		{
		}
		?>
      </ul></div>
      
      
    </div>
  </nav>
<hr>
  <div class="content-wrapper">
    <div class="container-fluid">
	
	 <?= $content ?>
     </div>
	</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>