<?php
use yii\helpers\Html;
?>
<hr>
<table id="dataTableShow" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sr No</th>
                <th>Request Id</th>
                <th>Name</th>
				<th>Mobile No</th>
				<th>Email</th>
				<th>Action</th>
            </tr>
        </thead>
        <tbody>
		<?php
		
		$i=1;
		foreach($getVisitmembers as $key=>$getVisitmembers)
		{
			$request_id=ucfirst($getVisitmembers['request_id']);
			$requestid=$getVisitmembers['request_id'];
			$menuid= Yii::$app->homeURL."department/visitorlist/detail?securekey=".$menuid."&requestid=".$requestid;
			$name=ucfirst($getVisitmembers['fname']);
			$mobile=ucfirst($getVisitmembers['mobile']);
			$email=ucfirst($getVisitmembers['email']);
			echo "<tr><td>$i</td><td>$request_id</td><td>$name</td><td>$mobile</td><td>$email</td>
			<td style='text-align: center;'><a href=''><button class='btn btn-sm ' style='background-color:transparent;'><img src='../../images/view.png' class='img-responsive cus-view-icon'>  </button></a>|<a href='$menuid'><button class='btn btn-sm ' style='background-color:transparent;'><img src='../../images/edit.png' class='img-responsive cus-view-icon'>  </button></a></td>
			</tr>";
			$i++;
		}
		?>
           
        </tbody>
        <tfoot>
             <tr>
                <th>Sr No</th>
                <th>Request Id</th>
                <th>Name</th>
				<th>Mobile No</th>
				<th>Email</th>
				<th>Action</th>
            </tr>
        </tfoot>
    </table>

	<script>
$(document).ready(function() {
    $('#dataTableShow').DataTable();
} );
</script>