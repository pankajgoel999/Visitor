<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = "User Registration";
//echo "<pre>"; print_r(COUNTRY); die;
$country = (explode(",",COUNTRY));
$country1 = (explode(",",COUNTRY));
$ids = (explode(",",IDENTIFICATION));
 
$states=Yii::$app->Utility->GetAllState();
/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    select, textarea, input{
        box-shadow: 2px 2px 2px  #a3f2c6 ;
    }
     .datepicker{
        background-color: white;
    }
</style>
<script type="text/javascript">
    <?php
    require("PhpEncodeFormContents.inc.php");
    $obj=new PhpEncodeFormContents("#_ZII_#");
    echo $obj->getBase64encodeJavascriptFunctions();
?>
    $('input.datepicker').datepicker({
    format: "dd-mm-yyyy",
    autoclose:true,
    //startDate: startdate,
    endDate: '+0d',
    }).click(function(){
        $('.datepicker-days').css('display','block');
    });
</script>
<style>
#error_main {
    background-color: #f2dede;
    color: red;
    font-weight: bold;
}
   
</style>
<div id="example1">
  <p></p>
</div>
<div class="user-profile-form container">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal','options'=>['enctype'=>'multipart/form-data','id'=>'visitor_reg', 'method'=>'POST','class' => 'form-horizontal',],
                                    'fieldConfig' => [
        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
        'horizontalCssClasses' => [
            'label' => 'col-sm-4 text-left',
            'wrapper' => 'col-sm-8 input-sm',
            'error' => '',
            'hint' => '',
        ],
    ],
]); ?>
<input type="hidden" id="_csrf" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />

<div class="row">
    <div class="col-sm-12">
        <h5 class="pagetitle"><?=Yii::t('yii', $this->title)?></h5>
        <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            if(!empty($message)){
                echo "<br><div class='text-center alert alert-$key'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span></button> <b>$message</b>
                </div>";
            }
        }
        ?>
        <span id="display_error" style="display:none;">
            <div class="col-sm-12 text-center">
                <div class="alert alert-danger" role="alert">
                  <span id="display_error_message"></span>
                </div>
            </div>
        </span>
        
        <span id='widgetversion_1_0_error_block' >
                <div class="alert alert-error error_main" id="error_main" style="display:none">  
                    <ul id="widget_error_main_inner" >
                    </ul>
                </div>         
        </span>
        
    </div>
    </div>
    <div class="row">
    <div class="col-sm-12">
        <div class="innertitle"><?=Yii::t('yii', 'Basic Details')?>:-</div>
    </div>
    </div>
    <div class="col-sm-12">
        
    <div class="col-sm-8">
        <div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'fname')->textInput([ 'class'=>'form-control form-control-sm charr', 'placeholder'=>$model->getAttributeLabel('fname'), 'autofocus' => true, 'autocomplete'=>'off', 'maxlength'=>'50']) ?>
    </div>
     
    <div class="col-sm-6">
        <?= $form->field($model, 'lname')->textInput([ 'class'=>'form-control form-control-sm charr', 'placeholder'=>$model->getAttributeLabel('lname'), 'autofocus' => true, 'autocomplete'=>'off', 'maxlength'=>'50']) ?>
    </div>
    </div>
        <div class="row">
     <div class="col-sm-6">
        <?= $form->field($model, 'mobile')->textInput([ 'class'=>'form-control form-control-sm ph', 'placeholder'=>$model->getAttributeLabel('mobile'), 'autofocus' => true, 'autocomplete'=>'off', 'maxlength'=>'10']) ?>
    </div>
    
     <div class="col-sm-6">
        <?= $form->field($model, 'dob')->textInput([ 'required' => true,'class'=>'form-control form-control-sm datepicker', 'placeholder'=>$model->getAttributeLabel('dob'), 'autofocus' => true, 'autocomplete'=>'off','readonly' => true]) ?>
         
    </div>
            </div>
        
    <div class="row">
            <div class="col-sm-6">
                 <?= $form->field($model, 'gender')->dropDownList([ 'M' => 'Male', 'F' => 'Female', 'O' => 'Other', ], ['prompt' => 'Select Gender']) ?>  
            </div>
        </div>
    </div>
    
    <div class="col-sm-4">
     
    <div class="col-sm-6">
        <span id="imagepreviewsrc">
            <img src="<?=Yii::$app->Utility->getdocumentpath("images/ppic-removebg-preview.png");?>" class="noimg">
        </span>    
    </div>    
    <div class="col-sm-6">   
            <input type="hidden" id="Image_type" name="Photo[Image_type]" value="" />
            <input type="hidden" id="Image_Ext" name="Photo[Image_Ext]" value="" />  
                    
            <span id="singleupload" class="btn btn-primary btn-file" style="cursor: pointer;   margin-left: 25%;margin-top:20px;">
                <span id="singleuploadtag">Upload Photo</span> 
                <input class="singleimageupload" style="opacity:0;position: absolute;" type="file" id="singleimageupload" accept=".jpg,.jpeg,.png" onchange="regstimg('singleimageupload','preview_image',this.files[0]);" name="UserProfile[photo]">
            </span>
                            
            <span id="removesingleupload" style="display:none; margin-left:24px;margin-top: 20px;"></span>
    </div>
    
       <label class="label label-danger">Format Jpeg, jpg or png only (Max <?=FILEUPLOADSIZE;?>kb)</label>          
       
      <br><br>  
    </div>
    
    </div>    
     <div class="row">
    <div class="col-sm-12">
        <div class="innertitle"><?=Yii::t('yii', 'Login Details')?>:-</div>
    </div>
        
    </div>
     <div class="col-sm-12">
            <div class="col-sm-4">
        <?= $form->field($model, 'email')->textInput([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('email'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>
         
            <div class="col-sm-4">
                <div class="form-group field-userprofile-password required">
                    <label class="control-label col-sm-4 text-left" for="userprofile-password">Password</label>
                    <div class="col-sm-8 input-sm">
                        <input type="password" id="userprofile-dpassword" class="form-control form-control-sm" name="UserProfile[dpassword]" placeholder="Password" autofocus="" autocomplete="off" aria-required="true">

                        <div class="help-block"></div>
                    </div>
                </div>   
            </div>
        
            <div class="col-sm-4">
                <div class="form-group field-userprofile-password required">
                    <label class="control-label col-sm-4 text-left" for="userprofile-cpassword">Confirm Password</label>
                    <div class="col-sm-8 input-sm">
                        <input type="password" id="userprofile-cpassword" class="form-control form-control-sm" name="UserProfile[cpassword]" placeholder="Confirm Password" autofocus="" autocomplete="off" aria-required="true">

                        <div class="help-block"></div>
                    </div>
                </div>   
            </div>
        <input type="hidden" id="password" name="UserProfile[password]" >
        
        </div>
    
    <div class="row">
    <div class="col-sm-12">
        <div class="innertitle"><?=Yii::t('yii', 'Personal Address Details')?>:-</div>
    </div>
        
    </div>
    <div class="col-sm-12">
    <div class="col-sm-4">
        <?= $form->field($model, 'personal_address')->textarea([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('personal_address'), 'autofocus' => true, 'autocomplete'=>'off']) ?><br><br>
    </div>
   
        <div class="col-sm-4">
        <div class="form-group field-userprofile-personal_country required">
            <label class="control-label col-sm-4 text-left" for="userprofile-personal_country">Country</label>
                 
            <div class="col-sm-8 input-sm">
                 <select class="js-example-basic-multiple form-control personal_country" id="userprofile-personal_country" name="UserProfile[personal_country]" required="true">
                    <?php
                        echo "<option value=''>Select Country</option>";
                        foreach ($country as $country) {
                          
                            echo '<option value="' . $country . '" >'.$country.'</option>';
                        }
                    ?>
                  </select>

            <div class="help-block"></div>
        </div>
        </div>
        </div>
   
        
    <div class="col-sm-4 pindia1" style="">
        <div class="form-group field-userprofile-personal_state required">
            <label class="control-label col-sm-4 text-left" for="userprofile-personal_state">State</label>
                <div class="col-sm-8 input-sm">
                 <select id="userprofile-personal_state" name="UserProfile[personal_state]" class="form-control common_getdistbystateP">
                    <?php
                    if(!empty($states)){
                        echo '<option value="" >Select State</option>';
                        foreach ($states as $state) {
                            $id= $state['StateId'];
                            $name= Yii::$app->Utility->getupperstring($state['StateName']);
                            echo "<option value='$id'>$name</option>";         
                        }
                    }else{
                        echo "<option value=''>No Records Found in DB. Contact Admin</option>";
                    }
                    ?>
                  </select>
            
            <div class="help-block"></div>
        </div>   
        </div>   
        </div>
    </div>  
    
    <div class="col-sm-12 pindia2">
        
    <div class="col-sm-4">
        <div class="form-group field-userprofile-personal_district required">
                <label class="control-label col-sm-4 text-left" for="userprofile-personal_district">District</label>
                   <div class="col-sm-8 input-sm">  
                    <select class="form-control common_getdistreg pdist" id="userprofile-personal_district" name="UserProfile[personal_district]">
                        <option value=''>Select District</option>
                    </select>
            <div class="help-block"></div>
        </div>   
        </div>   
     </div>    

    <div class="col-sm-4">
        <div class="form-group field-userprofile-personal_city required">
            <label class="control-label col-sm-4 text-left" for="userprofile-personal_city">City</label>
                <div class="col-sm-8 input-sm">
                <select class="form-control common_getcityreg pcity" id="userprofile-personal_city" name="UserProfile[personal_city]">
                        <option value=''>Select City</option>
                    </select>
            <div class="help-block"></div>
        </div> 
        </div> 
    </div>    
    
    <div class="col-sm-4">
        <?= $form->field($model, 'personal_pin')->textInput([ 'Maxlength'=> '6','class'=>'form-control form-control-sm ph', 'placeholder'=>$model->getAttributeLabel('personal_pin'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="innertitle"><?=Yii::t('yii', 'Official Address Details')?>:-</div>
        </div>
   </div>

    <div class="col-sm-12">
    <div class="col-sm-4">
        <?= $form->field($model, 'official_address')->textarea([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('official_address'), 'autofocus' => true, 'autocomplete'=>'off']) ?><br><br>
    </div>
        
     <div class="col-sm-4">
        <div class="form-group field-userprofile-official_country">
            <label class="control-label col-sm-4 text-left" for="userprofile-official_country">Country</label>
               <div class="col-sm-8 input-sm">  
            
                 <select class="js-example-basic-multiple form-control official_country" id="userprofile-official_country" name="UserProfile[official_country]" required="true">
                    <?php
                        echo "<option value=''>Select Country</option>";
                        foreach ($country1 as $country1) {
                          
                            echo '<option value="' . $country1 . '" >'.$country1.'</option>';
                        }
    
                    ?>
                  </select>

            <div class="help-block"></div>
        </div>
        </div>
        </div>   
        
    <div class="col-sm-4 oindia1">
        
        <div class="form-group field-userprofile-official_state">
            <label class="control-label col-sm-4 text-left" for="userprofile-official_state">State</label>
                 
                <div class="col-sm-8 input-sm">
                 <select id="userprofile-official_state" name="UserProfile[official_state]" class="form-control common_getdistbystateO">
                    <?php
                    if(!empty($states)){
                       
                        echo '<option value="" >Select State</option>';
                        foreach ($states as $state) {
                            $id= $state['StateId'];
                            $name= Yii::$app->Utility->getupperstring($state['StateName']);
                            
                            echo "<option value='$id'>$name</option>";         
                           
                        }
                    }else{
                        echo "<option value=''>No Records Found in DB. Contact Admin</option>";
                    }
                    ?>
                  </select>
            
            <div class="help-block"></div>
        </div>   
        </div>   
    </div>
        
    </div>   
    
    <div class="col-sm-12 oindia2">
    <div class="col-sm-4">
        
        <div class="form-group field-userprofile-official_district">
                <label class="control-label col-sm-4 text-left" for="userprofile-official_district">District</label> 
            <div class="col-sm-8 input-sm">
                    <select class="form-control common_getdistrego odist" id="userprofile-official_district" name="UserProfile[official_district]">
                        <option value=''>Select District</option>
                    </select>
            <div class="help-block"></div>
        </div>   
        </div>   
    </div>
        
    <div class="col-sm-4">
        <div class="form-group field-userprofile-official_city">
            <label class="control-label col-sm-4 text-left" for="userprofile-official_city">City</label>
              <div class="col-sm-8 input-sm">  
                <select class="form-control common_getcityrego ocity" id="userprofile-official_city" name="UserProfile[official_city]">
                        <option value=''>Select City</option>
                    </select>
            <div class="help-block"></div>
        </div> 
        </div> 
    </div>
        
    <div class="col-sm-4">
        <?= $form->field($model, 'official_pin')->textInput([ 'Maxlength'=> '6', 'class'=>'form-control form-control-sm ph', 'placeholder'=>$model->getAttributeLabel('official_state'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>
        
    </div>  

    <div class="row">
        <div class="col-sm-12">
            <div class="innertitle"><?=Yii::t('yii', 'Identification Details')?>:-</div>
        </div>
   </div>
     <div class="col-sm-12">
    <div class="col-sm-4">
        
        <div class="form-group field-userprofile-id_type required">
            <label class="control-label col-sm-4 text-left" for="userprofile-id_type">Type</label>
                <div class="col-sm-8 input-sm">   
            
                 <select class="js-example-basic-multiple form-control id_type" id="userprofile-id_type" name="UserProfile[id_type]" required="true">
                    <?php
                        echo "<option value=''>Select Type</option>";
                        foreach ($ids as $id) {
                          
                            echo '<option value="' . $id . '" >'.$id.'</option>';
                        }
    
                    ?>
                  </select>

            <div class="help-block"></div>
        </div>
        </div>
    </div>
         
    <div class="col-sm-4">
        <?= $form->field($model, 'id_number')->textInput([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('id_number'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>
         
    <div class="col-sm-4">  
        
        <div class="form-group field-userprofile-id_file required">
             <label class="control-label col-sm-4 text-left" for="userprofile-id_file">Proof</label>
                 
            <div class="col-sm-8 input-sm">  
         <span id="pdfpreviewsrcid_file"></span>
         <span id="pdfuploadid_file" class="btn btn-info btn-file">
            <span id="pdfuploadtagid_file">Upload</span> 
            <input type="file" id="id_file" name="UserProfile[id_file]" accept=".pdf" onchange="upload_pdf_file('id_file','preview_image',this.files[0]);">
         </span>
         <span id="removepdffileid_file" style="display:none;"></span><br>

        <input type="hidden" value="" id="chkid_file"> 
       <br>
            <label class="label label-danger">upload only pdf format (Max <?=FILEUPLOADSIZE;?>kb)</label>
        </div>
        </div>
        
    </div>
         
    </div>     
    <br><br><br>
    <br><br><br>
    
    <div class="col-sm-12"><hr></div>
            
        
 <div class="col-md-12 col-sm-12 sub_heading"> <b>Disclaimer</b></div> 
    <div class="col-md-12 col-sm-12">
     <input type="checkbox" name="disclaimer" id="disclaimer" value="1" required><b> &nbsp;&nbsp;All information provided above are true and correct to the best of my knowledge. Department have right to cancel your appointment any time without any notice. You have to carry the ID carry uploaded at the time of Registration.
        </b>
    </div>
    
      <div class="col-sm-12"><hr></div>
    <div class="row">
    <div class="col-sm-3">
   
        <label>Enter Captcha</label>
        <input type="text" class="form-control form-control-sm" required="" name="UserProfile[captcha]" id="regd_captcha" placeholder="Enter Captcha" maxlength="5"  autocomplete="off" />
    </div>
         <div class="col-sm-1"></div>
    <div class="col-sm-4">
        <div style="padding-top: 15px;">
            <img src="<?php echo Yii::$app->homeUrl; ?>internals/captcha.php" alt="" id="registrationcaptcha" />
            <img src="<?php echo Yii::$app->homeUrl; ?>images/refresh.jpg" alt="" id="registrationrefresh" title="Click to refresh captcha image" style="cursor:pointer;margin- width: 33px;border-radius: 11px;" />
        </div>
    </div>
         
     <div class="col-sm-4">
        <br>
        <button type="button" class="btn btn-success btn-sm" id="regbtn">Submit</button>
        <button type="reset" class="btn btn-danger btn-sm">Reset</button>
        <br><br><br><br>
    </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<script>
$(document).ready(function(){
    $("#Image_type").val('');
    $("#Image_Ext").val('');
    $(".pindia1").hide();
    $(".pindia2").hide();
     $(".oindia1").hide();
        $(".oindia2").hide(); 
});
</script>