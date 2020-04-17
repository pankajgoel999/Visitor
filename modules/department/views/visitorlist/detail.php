<script>
function toggleIcon(e) 
{
    $(e.target).prev('.panel-heading').find(".more-less").toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>
<?php
//echo "<pre>";print_r($getVisitmembers); 
foreach($getVisitmembers as $key =>$data)
{
	$fname=ucfirst($data["fname"]);
	$request_id=ucfirst($data["request_id"]);
	$lname=ucfirst($data["lname"]);
	$mobile=ucfirst($data["mobile"]);
	$email=ucfirst($data["email"]);
	$personal_address=ucfirst($data["personal_address"]);
	$personal_country=ucfirst($data["personal_country"]);
	$personal_state=ucfirst($data["personal_state"]);
	$personal_district=ucfirst($data["personal_district"]);
	$personal_city=ucfirst($data["personal_city"]);
	$personal_pin=ucfirst($data["personal_pin"]);
	$official_address=ucfirst($data["official_address"]);
	$official_country=ucfirst($data["official_country"]);
	$official_state=ucfirst($data["official_state"]);
	$official_district=ucfirst($data["official_district"]);
	$official_city=ucfirst($data["official_city"]);
	$official_pin=ucfirst($data["official_pin"]);
	$id_type=ucfirst($data["id_type"]);
	$id_number=ucfirst($data["id_number"]);
	$id_file=ucfirst($data["id_file"]);
	$personal_photo=ucfirst($data["personal_photo"]);
	$purpose=ucfirst($data["purpose"]);
	$remarks=ucfirst($data["remarks"]);
	$visit_date=date("d-M-Y",strtotime($data["visit_date"]));
	$visit_time=date("H:i:s",strtotime($data["visit_time"]));
}
$visitormemberdata = Yii::$app->Boutility->getVisit_members($request_id);
$visitormemberweapons = Yii::$app->Boutility->getWapons_detail($request_id);
$getStatus = Yii::$app->Boutility->getStatus();

//echo "<pre>";print_r($visitormemberdata); die;
?>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Basic Information of Visitor (Request ID:<b><?=$request_id?></b>)
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse active" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
				    <h4 class="text-danger "><b><u>Personal Information</u></b>:</h4>
                    <div class="row">
						<div class="col-sm-4">
						<label for="text">First Name:</label> <br><?=$fname?>
						</div>
						<div class="col-sm-4">
						<label for="text">Last Name:</label><br><?=$lname?>
						</div>
						<div class="col-sm-4">
						<label for="text">Phone Number:</label><br><?=$mobile?>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-4">
						<label for="text">Email:</label><br><?=$email?>
						</div>
						<div class="col-sm-4">
						<label for="text">Address:</label><br><?=$personal_address?>
						</div>
						<div class="col-sm-4">
						<label for="text">Country:</label><br><?=$personal_country?>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-4">
						<label for="text">State:</label>
						<br><?=$personal_state?>
						</div>
						<div class="col-sm-4">
						<label for="text">District:</label>
						<br><?=$personal_district?>
						</div>
						<div class="col-sm-4">
						<label for="text">City:</label>
						<br><?=$personal_city?>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-4">
						<label for="text">Pin Code:</label>
						<br><?=$personal_pin?>
						</div>
					</div>
					<h4 class="text-danger "><b><u>Office Information</u></b>:</h4>
					<div class="row">
						<div class="col-sm-4">
						<label for="text">Office Address:</label>
						<br><?=$official_address?>
						</div>
						<div class="col-sm-4">
						<label for="text">Office Country:</label>
						<br><?=$official_country?>
						</div>
						<div class="col-sm-4">
						<label for="text">Office State:</label>
						<br><?=$official_state?>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-4">
						<label for="text">Office District:</label>
						<br><?=$official_district?>
						</div>
						<div class="col-sm-4">
						<label for="text">Office City:</label>
						<br><?=$official_city?>
						</div>
						<div class="col-sm-4">
						<label for="text">Office Pin Code:</label>
						<br><?=$official_pin?>
						</div>
					</div>
					
				</div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Visiting Member's Details
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <h4 class="text-danger "><b><u>Visit Detail</u></b>:</h4>
					<div class="row">
						<div class="col-sm-4">
						<label for="text">Id Proof Type:</label>
						<br><?=$id_type?>
						</div>
						<div class="col-sm-4">
						<label for="text">Id Proof Number:</label>
						<br><?=$id_number?>
						</div>
						<div class="col-sm-4">
						<label for="text">Purpose for Visit:</label>
						<br><?=$purpose?>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-4">
						<label for="text">Date of Visit: </label>
						<br><?=$visit_date?>
						</div>
						<div class="col-sm-4">
						<label for="text">Time of Visit:</label>
						<br><?=$visit_time?>
						</div>
					</div>
					<br>
					<table class="table table-bordered table-striped">
						  <thead class="thead-dark">
							<tr>
							  <th>Sr. No.</th>
							  <th>Name</th>
							  <th>Phone Number</th>
							  <th>Email</th>
							  <th>Address</th>
							  <th>Mobile</th>
							  <th>Laptop</th>
							  <th>Other Material</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$i=1;
							foreach($visitormemberdata as $key=>$info)
							{
							
							$name=ucfirst($info["name"]);	
							$mobile=ucfirst($info["mobile"]);	
							$email=ucfirst($info["email"]);	
							$address=ucfirst($info["address"]);	
							$with_mobile= Yii::$app->Boutility->getYesorNO($info["with_mobile"]);
							$with_laptop= Yii::$app->Boutility->getYesorNO($info["with_laptop"]);
							$other_material=ucfirst($info["other_material"]);	
							?>
							<tr>
							  <th scope="row"><?=$i?></th>
							  <td><?=$name?></td>
							  <td><?=$mobile?></td>
							  <td><?=$email?></td>
							  <td><?=$address?></td>
							  <td><input type="checkbox" checked data-toggle="toggle" data-on="Allowed" data-off="Not Allowed" data-onstyle="success" data-offstyle="danger"></td>
							  <td><input type="checkbox" checked data-toggle="toggle" data-on="Allowed" data-off="Not Allowed" data-onstyle="success" data-offstyle="danger"></td>
							  <td><?=$other_material?></td>
							</tr>
							<?php $i++;}?>
						  </tbody>
					</table>
					
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Weapon's Details
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                   
					<br>
					<table class="table table-bordered table-striped">
						  <thead class="thead-dark">
							<tr>
							  <th>Sr. No.</th>
							  <th>Member Name</th>
							  <th>Weapon Detail</th>
							  <th>Weapon License</th>
							  <th>Weapon License No</th>
							  <th>License Valid Till</th>
							  <th>Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$i=1;
							foreach($visitormemberweapons as $key=>$winfo)
							{
							$member_id=ucfirst($winfo["member_id"]);	
							$getSingleVisitmembersinfo= Yii::$app->Boutility->getSingleVisitmembersinfo($member_id);
							//echo "<pre>";print_r($getSingleVisitmembersinfo["name"]); die;
							$memName=$getSingleVisitmembersinfo["name"];
							$weapon_detail=ucfirst($winfo["weapon_detail"]);	
							$weapon_license=Yii::$app->Boutility->getYesorNO($winfo["weapon_license"]);	
							$weapon_lic_no=ucfirst($winfo["weapon_lic_no"]);
							$lic_valid_till=date("d-M-Y",strtotime($winfo["lic_valid_till"]))	
							?>
							<tr>
							  <td><?=$i?></td>
							  <td><?=$memName?></td>
							  <td><?=$weapon_detail?></td>
							  <td><?=$weapon_license?></td>
							  <td><?=$weapon_lic_no?></td>
							  <td><?=$lic_valid_till?></td>
							  <td><input type="checkbox" checked data-toggle="toggle" data-on="Allowed" data-off="Not Allowed" data-onstyle="success" data-offstyle="danger"></td>
							</tr>
							<?php $i++;}?>
						  </tbody>
					</table>
					
                </div>
            
            </div>
        </div>

    </div><!-- panel-group -->
	<br>
	<div class="row">
		<div class="col-sm-4">
		<label for="text">Action to be Taken:</label><br>
		<select class="form-control boaction" id="boaction" name="boaction">
			<option value="">--Select Action--</option>
		<?php
		foreach($getStatus as $key=>$sinfo)
		{
			$ststype=$sinfo["type"];
			$stsdes=$sinfo["Description"];
			echo "<option value='$ststype'>$stsdes</option>";
		}
		?>
		</select>
		</div>
		<div class="col-sm-4">
		<label for="text">Remarks:</label><br>
		<textarea class="form-control" id="remarks" name="remarks"></textarea>
		</div>
		<div class="col-sm-4"></div>
	</div>