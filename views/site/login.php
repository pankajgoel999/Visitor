<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = "Login";

/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    select, textarea, input{
        box-shadow: 2px 2px 2px  #a3f2c6 ;
    }
</style>
 
<div id="example1">
  <p></p>
</div> 
<script type="text/javascript">
// Using jQuery.

$(function() {
    $('form').each(function() {
        $(this).find('input').keypress(function(e) {
             if(e.which == 10 || e.which == 13) {
               encForm1();
            }
        });

        
    });
});
 
            var secret="#_ZII_#";
            
            <?php
                require("PhpEncodeFormContents.inc.php");
                $obj=new PhpEncodeFormContents("#_ZII_#");
                echo $obj->getBase64encodeJavascriptFunctions();
                
            ?>
                
            function encForm1(){ 
                var pwd = $("#loginform-duppassword").val();
                // alert(pwd);
				if($.trim($("#captcha").val())==''){
					$("#captcha").focus();
					return false;
				}
                 if(pwd != ''){
                    ob('loginform-duppassword');
					$("#loginform-password").val($("#loginform-duppassword").val());
					$(":password").remove(); 
                }
				
               $("#w0").submit();
            }
            function encForm2(){
                ob('uname2');
                ob('passwd2');
				$("#loginform-password").val($("#loginform-duppassword").val());
				$("#loginform-duppassword").val('');
				//
               $$$('demo2').submit();
            }
            function $$$(i){
                return document.getElementById(i);
            }
            function ob(i){
                var val=$$$(i).value;
                var encrypted = CryptoJS.AES.encrypt(JSON.stringify(val), secret, {format: CryptoJSAesJson}).toString();
				 
                $$$(i).value=encrypted;  
            } 
        </script>

 
<style>
  #w0 {
	padding: 20px;
}.help-block.help-block-error {
	color: #f5bdbc;
	margin: 8px;
}.btn.btn-login.float-right {
	background: #bd6161;
}
</style>
<section class="login-block">
    <div class="container">
	<div class="row">
	<div class="col-sm-3 text-center">
        <img class="police1" src="<?=Yii::$app->Utility->getdocumentpath("images/police1.jpg");?>" width="255px"/>
    </div>
	
		<div class="col-md-6 login-sec login-div">
		    <h2 class="text-center login_head">Login Now</h2>
		   <?php 	$form = ActiveForm::begin(['action' => 'login','layout' => 'horizontal','options'=>[ 'autocomplete' => 'off','class' => 'form-horizontal',],
					    'fieldConfig' => [
						'template' => "{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
						'horizontalCssClasses' => [
							'label' => 'col-sm-3 text-left',
							'wrapper' => 'col-sm-12 input-sm',
							'error' => '',
							'hint' => '',
						      ],
					       ],
                                   
			         ]); ?>
			<?php
	                   foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
		                  echo '<div class="col-sm-12 col-xs-12 text-center alert alert-' . $key . '" style="margin-bottom:15px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> ' . $message . '</div>';
	                   }
                    ?>
  <div class="form-group">
    <label for="exampleInputEmail1" class="text-uppercase">Username :</label>
    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder'=>'User Name','autocomplete' => 'off']) ?>
     
  </div>
  <div class="form-group" style="margin-top: 25px;">
    <label for="exampleInputPassword1" class="text-uppercase">Password :</label>
   <?= $form->field($model, 'duppassword')->passwordInput(['placeholder'=>'Password','autocomplete' => 'off']) ?>
   <?= $form->field($model, 'password')->hiddenInput(['placeholder'=>'Password','autocomplete' => 'off'])->label(false); ?>
   </div>
   <div class="form-group">
                     
                          
		<div class="col-sm-6" style="margin-left: -18px;">
			<input type="text" id="captcha" name="LoginForm[entercaptcha]" class="form-control ch" placeholder="Captcha" style="min-width: 175px;" title="Captcha" autocomplete="off" maxlength="4" required  />
		</div>
		<div class="col-sm-6">
			<img src="<?=Yii::$app->homeUrl;?>internals/captcha.php" style="margin: 0px 0 0 6px;border-radius: 8px;" alt="" id="captchaimg" />
			<img src="<?=Yii::$app->homeUrl; ?>images/refresh.jpg" alt=""  id="refreshcaptcha" style="cursor:pointer;margin-top: -20%;margin-left: 70%;width: 33px;border-radius: 11px;" />
		</div>
                                            
                                            
                      
				</div>
  
    <div class="form-check" style="margin: -18px 0 10px 0;">
    <label class="form-check-label">
      <input type="checkbox" class="form-check-input">
      <small>Remember Me</small>
    </label>
    <button type="button" onclick="encForm1()" class="btn btn-success float-right btn-sm">Login</button>
        <input type="reset" class="btn btn-danger btn-sm" value="Reset">
  </div>
  
<!-- <div class="copy-text"> <a href="#" style="color: #fff;">Forgot Password?</a></div> -->
<?php ActiveForm::end();  
            $pwd = Yii::$app->homeUrl."site/forgotpassword";
                        $reg = Yii::$app->homeUrl."registration";
                        ?>
                        <div class="row">
                            <div class="col-sm-6 col-6 text-left">
                                <a href="<?=$reg?>" class="commonlink btn btn-outline-info btn-sm" title="Farmer Registration"><?=Yii::t('yii', 'Sign Up')?></a>
                            </div>
                            <div class="col-sm-6 col-6 text-right">
                                <a href="<?=$pwd?>" class="commonlink btn btn-outline-danger btn-sm" title="Forgot Password"><?=Yii::t('yii', 'Forgot Password')?></a>
                            </div>
                        </div>
		</div>
		<div class="col-sm-3 text-center">
        <img class="police1" src="<?=Yii::$app->Utility->getdocumentpath("images/police2.jpg");?>" width="255px"/>
    </div>
</div>
</div></section>
 
<script>
$(document).ready(function(){
    $("#loginsubmit").click(function(){
        var password = $.trim($("#loginform-password").val());
       // password = md5(password);
        //$("#loginform-password").val(password)
    });
});
    function show(id){
        if(id=='sel'){ 
            $(".land").hide();$(".sel").show();
            $(".unit").hide();
            $(".operation").hide();
        }
        if(id=='land'){ 
            $(".sel").hide();$(".land").show();
            $(".unit").hide();
            $(".operation").hide();
        }
        if(id=='unit'){ 
            $(".land").hide();$(".unit").show();
            $(".sel").hide();
            $(".operation").hide();
        }
        if(id=='operation'){ 
            $(".land").hide();$(".operation").show();
            $(".unit").hide();
            $(".sel").hide();
        }
        
	}
    function home(){
         $("#myModal").modal('toggle');
    }
	
</script>
