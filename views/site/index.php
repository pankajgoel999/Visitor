<?php

/* @var $this yii\web\View */

$this->title = 'Visitor Management';
?>
<div id="banner-wrapper" >
</div>
<?php
             
            $reglink = Yii::$app->homeUrl."registration";
            $statuslink = Yii::$app->homeUrl."site/checkstatus";
            $loginlink = Yii::$app->homeUrl."site/login";
        ?>
<div id="page-wrapper">
	<div id="page" class="container">
		<div class="pboxA">
			<h3>User Registration</h3>
			<p><img src="<?=Yii::$app->homeUrl?>images/registration.png" alt="" class="image image-left icons" />You need to register one time for making visitor request</p>
			<a href="<?=$reglink;?>" class="orange">Register Me</a>
		</div>
		<div class="pboxB">
			<h3>Check Application Status</h3>
			<p><img src="<?=Yii::$app->homeUrl?>images/status.png" alt="" class="image image-left icons" />Check status of Already submitted request using Request ID</p>
			<a href="<?=$statuslink;?>" class="green">Check Status</a>
		</div>
		<div class="pboxC">
			<h3>Login</h3>
			<p><img src="<?=Yii::$app->homeUrl?>images/login.png" alt="" class="image image-left icons" />Login here for new request and department use.</p>
			<a href="<?=$loginlink;?>" class="red">Login</a>
		</div>
	</div>
	
	
</div>

<div id="footer-wrapper">
	<div id="footer" class="container">
		<div id="fbox1">
		<div id="inner">
            <div class="inner_heading">
			<h2>Latest Updates</h2>
            </div>
			<ul class="style3">
                <marquee direction = "up">
				<li class="first">
					<p class="date"><a href="#">Nov<b>15</b></a></p>
					<h3>Amet sed volutpat mauris</h3>
					<p><a href="#">Mauris nibh sodales adipiscing dolore.</a></p>
				</li>
				<li>
					<p class="date"><a href="#">Nov<b>11</b></a></p>
					<h3>Sagittis diam dolor sit amet</h3>
					<p><a href="#">Duis arcu tortor fringilla sed  sed magna.</a></p>
				</li>
				<li>
					<p class="date"><a href="#">Nov<b>09</b></a></p>
					<h3>Sagittis diam dolor sit amet</h3>
					<p><a href="#">Duis arcu tortor fringilla sed  sed magna.</a></p>
				</li>
            </marquee>
			</ul>
		</div>
		</div>
		<div id="fbox2">
            <div id="inner">
                <div class="inner_heading">
			<h2>Message from the DGP, Haryana</h2>
                    </div>
    
            <div class="row">
                <div class="col-sm-8"><p align="justify" style="margin-left:10px;">I extend a heartly welcome to all on the website of Haryana Police.</p>
                    
                    <p align="justify">
 
Haryana Police has been serving people of Haryana with dedication since the creation of the State on 1.11.1966. The officers and men of Haryana Police have worked tirelessly in the face of daunting challenges throughout the past year to maintain effective control over crime and criminals. Various key initiatives like modernization, induction of Information Technology .. more</p> </div>
                <div class="col-sm-4">
                    <img src="<?=Yii::$app->homeUrl?>images/DGP_Manoj_Yadav.jpg" width="150px" height="200px"><br><b style="font-size:12px;">Shri. Manoj Yadava, IPS 
Director General of Police,
Haryana.</b>
                </div>
            </div>
			 
			
		</div>
		</div>
        
	</div>
    <br>
    <ul class="style1 slider_lower">
                <marquee>
				<li><img src="<?=Yii::$app->homeUrl?>images/s1.jpg" width="180" height="120" alt="" /></li>
				<li><img src="<?=Yii::$app->homeUrl?>images/s2.jpg" width="180" height="120" alt="" /></li>
				<li><img src="<?=Yii::$app->homeUrl?>images/s4.jpg" width="180" height="120" alt="" /></li>
				 
                    </marquee>
			</ul>
</div>
