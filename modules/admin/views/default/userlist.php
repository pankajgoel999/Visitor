<?php

use yii\helpers\Html;
// "mmmm".$menuid; die;
?>
<div class="row  text-right">
<a href="<?=  Yii::$app->homeUrl?>admin/default/registration?securekey=<?=$menuid?>" class="btn  btn-primary">Create Department User</a>
</div>
<hr>
<table id="dataTableShow" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
				<th>Sr. No.</th>
                <th>Dept Name</th>
                <th>Dept Email</th>
                <th>Dept Contact No</th>
                <th>Officer Name</th>
                <th>Officer Mobile No</th>
				<th>Action</th>
            </tr>
        </thead>
        <tbody>
		<?php
		$i=1;
		foreach($users as $key=>$userdata)
		{
			$dept_name=ucfirst($userdata['dept_name']);
			$dept_email=$userdata['dept_email'];
			$dept_contactno=$userdata['dept_contactno'];
			$nodal_officer_fname=ucfirst($userdata['officer_fname']);
			$nodal_officer_mobile=$userdata['officer_mobile'];
			echo "<tr><td>$i</td><td>$dept_name</td><td>$dept_email</td><td>$dept_contactno</td><td>$nodal_officer_fname</td><td>$nodal_officer_mobile</td>
			<td style='text-align: center;'><a href=''><button class='btn btn-sm ' style='background-color:transparent;'><img src='../../images/view.png' class='img-responsive cus-view-icon'>  </button></a>|<a href=''><button class='btn btn-sm ' style='background-color:transparent;'><img src='../../images/edit.png' class='img-responsive cus-view-icon'>  </button></a></td>
			</tr>";
			$i++;
		}
		?>
           
        </tbody>
        <tfoot>
            <tr>
                <th>Sr. No.</th>
                <th>Dept Name</th>
                <th>Dept Email</th>
                <th>Dept Contact No</th>
                <th>Officer Name</th>
                <th>Officer Mobile No</th>
				<th>Action</th>
            </tr>
        </tfoot>
    </table>

	<script>
$(document).ready(function() {
    $('#dataTableShow').DataTable();
} );
</script>