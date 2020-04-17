<style>
    select, textarea, input{
        box-shadow: 2px 2px 2px  #a3f2c6 ;
    }
</style>
<form id="deptreg" action="<?=Yii::$app->homeUrl?>admin/default/registration" method="post">
<input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
<div class="row">
    <div class="col-sm-12">
        <h4 class="pagetitle">Department User Registration</h4>
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
			<label class="control-label" >Department Name</label>
			<input type="text" id="dname" class="form-control form-control-sm" name="dname" placeholder="Department Name" autofocus autocomplete="off" aria-required="true">
		</div>   
	</div> 
<div class="col-sm-6">
        <div class="form-group required">
			<label class="control-label" >Department Email</label>
			<input type="email" id="demail" class="form-control form-control-sm" name="demail" placeholder="Department Email" autofocus autocomplete="off" aria-required="true">
			<p style="color:red">Department Email is default username for department login</p>
		</div>   
	</div>	
</div> 
<div class="row">
    <div class="col-sm-6">
        <div class="form-group required">
			<label class="control-label" >Department Contact No</label>
			<input maxlength="10" type="text" id="dcontactno" class="form-control form-control-sm" name="dcontactno" placeholder="Department Contact No" autofocus autocomplete="off" aria-required="true">
		</div>    
	</div> 
<div class="col-sm-6">
        <div class="form-group required">
			<label class="control-label" >Department Address</label>
			<textarea id="address" class="form-control form-control-sm" name="address" placeholder="Department Address" autofocus autocomplete="off" aria-required="true"></textarea>
		</div>   
	</div>	
</div> 
<div class="row">
    <div class="col-sm-6">
        <div class="form-group required">
			<label class="control-label" >Department Officer Name</label>
			<input type="text" id="nodalname" class="form-control form-control-sm" name="nodalname" placeholder="Department Officer Name" autofocus autocomplete="off" aria-required="true">
		</div>   
	</div> 
<div class="col-sm-6">
        <div class="form-group required">
			<label class="control-label" >Department Officer Email</label>
			<input type="text" id="nodalemail" class="form-control form-control-sm" name="nodalemail" placeholder="Department Officer Email" autofocus autocomplete="off" aria-required="true">
		</div>   
	</div>	
</div> 
<div class="row">
    <div class="col-sm-6">
        <div class="form-group required">
			<label class="control-label" >Department Officer Number</label>
			<input maxlength="10" type="text" id="nodalno" class="form-control form-control-sm" name="nodalno" placeholder="Department Officer Number" autofocus autocomplete="off" aria-required="true">
		</div>   
	</div> 
<div class="col-sm-6">
        <div class="form-group required">
			<label class="control-label" >Select Department for which you want to create user</label>
			
			<?php
			$roles= Yii::$app->Boutility->getRoles(null);
			//echo "<pre>";print_r($roles); die;
			?>
			<select id="roles" class="form-control form-control-sm" name="roles">
			<option value="">Select Department</option>
			<?php
			foreach($roles as $key=>$role)
			{
				$roleid=$role['role_id'];
				//echo $roleid; die;
				$role_name=$role['role_name'];
				echo "<option value='$roleid'>$role_name</option>";
			}
			?>
			</select>

		</div>   
	</div>	
</div> 
<div class="row">
    <div class="col-sm-6">
        <div class="form-group required">
			<label class="control-label" >Department Officer Emp Code</label>
			<input type="text" id="empcode" class="form-control form-control-sm" name="empcode" placeholder="Department Officer Emp Code" autofocus autocomplete="off" >
		</div>   
	</div> 
<div class="col-sm-6">
        <div class="form-group required">
			<label class="control-label" >Department Officer Designation</label>
			<input type="text" id="designation" class="form-control form-control-sm" name="designation" placeholder="Department Officer Designation" autofocus autocomplete="off" aria-required="true">
		</div>   
	</div>	
</div> 
<div class="row">
    <div class="col-sm-6">
        <div class="form-group required">
			<label class="control-label" >Password</label>
			<input type="password" id="password" class="form-control form-control-sm" name="password" placeholder="Password" autofocus autocomplete="off" aria-required="true">
		</div>   
	</div> 

</div> 
<center>
 <button type="button" class="btn btn-success " id="deptregbtn" onclick="return departmentReg()">Submit</button>
        <button type="reset" class="btn btn-danger">Reset</button>
</center>
</form>