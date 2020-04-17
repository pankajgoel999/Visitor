<?php

use yii\helpers\Html;

?>
<div class="row  text-right">
<a href="<?=  Yii::$app->homeUrl?>admin/managerole/createrole?securekey=<?=$menuid?>" class="btn  btn-primary">Create Department Roles</a>
</div>
<hr>
<table id="dataTableShow" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sr No</th>
                <th>Role Name</th>
                <th>Is Active</th>
				<th>Action</th>
            </tr>
        </thead>
        <tbody>
		<?php
		$i=1;
		foreach($roles as $key=>$roledata)
		{
			$role_name=ucfirst($roledata['role_name']);
			$is_active=ucfirst($roledata['is_active']);
			$is_active= Yii::$app->Boutility->getYesorNO($is_active);
			echo "<tr><td>$i</td><td>$role_name</td><td>$is_active</td>
			<td style='text-align: center;'><a href=''><button class='btn btn-sm ' style='background-color:transparent;'><img src='../../images/view.png' class='img-responsive cus-view-icon'>  </button></a>|<a href=''><button class='btn btn-sm ' style='background-color:transparent;'><img src='../../images/edit.png' class='img-responsive cus-view-icon'>  </button></a></td>
			</tr>";
			$i++;
		}
		?>
           
        </tbody>
        <tfoot>
            <tr>
                <th>Sr No</th>
                <th>Role Name</th>
                <th>Is Active</th>
				<th>Action</th>
            </tr>
        </tfoot>
    </table>

	<script>
$(document).ready(function() {
    $('#dataTableShow').DataTable();
} );
</script>