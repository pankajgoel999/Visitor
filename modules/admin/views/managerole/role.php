<style>
    select, textarea, input{
        box-shadow: 2px 2px 2px  #a3f2c6 ;
    }
</style>
<form id="deptroles" action="<?=Yii::$app->homeUrl?>admin/managerole/createrole" method="post">
<input type="hidden" name="_csrf" value="IFLFcQDkYR73AwRw4Hbxl68zMDWl45gEvLJ0W0LlXfBDJrcaNoIRT89gdh-yB5ynm2NGQt25wjHX0EQZGsg2tw==">
<div class="row">
    <div class="col-sm-12">
        <h4 class="pagetitle">Department Role</h4>
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
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group required">
			<label class="control-label" >Role Name</label>
			<input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
			<input type="text" id="rolename" class="form-control form-control-sm" name="rolename" placeholder="Role Name" autofocus autocomplete="off" aria-required="true">
		</div>   
	</div> 
	<div class="col-sm-6">
        <div class="form-group required">
			<label class="control-label" >Is Active</label>
			<br>
			<button id='is_active_yes' type="button" class="btn btn-sm btn-primary btncllls  " >Yes</button>
            <button  id='is_active_no' type="button" class="btn btn-sm btn-primary btncllls " >No</button>    
            <input name="is_active" id="is_active_roles" type="hidden" value=""> 
		</div>    
	</div> 
	
</div> 
<br><br> 
<center>
 <button type="button" class="btn btn-success " id="deptrolebtn" onclick="return departmentRoles()">Submit</button>
        <button type="reset" class="btn btn-danger">Reset</button>
</center>
</form>