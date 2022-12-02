<?php include_once('config2.php');?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Browse Groups</title>
	
	<style>
body {
  background-image: url('photo.jpeg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
}
table { background-color: #ff0000; }
tr { background-color: yellow; }
td { background-color: white; }
</style>
	<link rel="stylesheet" href="include/jquery-ui.css" type="text/css">
   
	<link rel="stylesheet" href="include/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="include/all.css" rel="stylesheet">
</head>

<body>
	
	
	
	<?php
	$condition	=	'';
	if(isset($_REQUEST['app']) and $_REQUEST['app']!=""){
		$condition	.=	' AND application LIKE "%'.$_REQUEST['app'].'%" ';
	}
	if(isset($_REQUEST['target_group']) and $_REQUEST['target_group']!=""){
		$condition	.=	' AND target_group LIKE "%'.$_REQUEST['target_group'].'%" ';
	}

	
	$userData	=	$db->getAllRecords('api','*',$condition,'ORDER BY Expiry_date DESC');
	?>
   	<div class="container">
		<h1 style="color:white;" >Browse Groups</h1>
		<?php
		if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="edit-success"){
			echo	'<div class="alert alert-success">Record Modified</div>';
		}
		if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="deleted"){
			echo	'<div class="alert alert-success">Group '. $_REQUEST['editId'] .' Deleted</div>';
		}
		?>
		<div class="card">
			<div class="card-header"> <strong></strong> 
			<a href="add-group.php" class="float-center btn btn-dark btn-sm"> Add Groups</a>
			 <strong></strong> 
			<a href="browse-users.php" class="float-center btn btn-dark btn-sm"> Browse Users</a>
		</div>
			<div class="card-body">
				
				<div class="col-sm-12">
					<h5 class="card-title"> Find Groups</h5>
					<form method="get">
						<div class="row">
							<div class="col-sm-2">
								<div class="form-group">
									<label>Application</label>
									<input type="text" name="app" id="app" class="form-control" value="<?php echo isset($_REQUEST['app'])?$_REQUEST['app']:''?>" placeholder="Enter app name">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label>Group</label>
									<input type="text" name="target_group" id="target_grop" class="form-control" value="<?php echo isset($_REQUEST['target_group'])?$_REQUEST['target_group']:''?>" placeholder="Enter Group Name">
								</div>
							</div>
						
							
							<div class="col-sm-3">
								<div class="form-group">
									<label>&nbsp;</label>
									<div>
										<button type="submit" name="submit" value="search" id="submit" class="btn btn-primary"> Search</button>
										<a href="<?php echo $_SERVER['PHP_SELF'];?>" class="btn btn-danger"> Clear</a>
									</div>
									
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<hr>
		
		<div>
			<table class="table table-striped table-bordered">
				<thead>
					<tr class="bg-primary text-white">
                    <th>Sr#</th>
						<th>Expiry_Date</th>
						<th>passkey</th>
						<th>Valid</th>
						<th>Application</th>
                        <th>Target Group</th>
			<th>API</th>
                        <th class="text-center">Action</th>

					</tr>
				</thead>
				<tbody>
					<?php 
					if(count($userData)>0){
						$s	=	'';
						foreach($userData as $val){
							$s++;
					?>
					<tr>
						<td><?php echo $s;?></td>
						<td><?php echo $val['Expiry_date'];?></td>
						<td><?php echo $val['passkey'];?></td>
                        <td><?php echo $val['Valid'];?></td>
                        <td><?php echo $val['application'];?></td>
                        <td><?php echo $val['target_group'];?></td>
<td><?php $host= gethostname();
$ip = gethostbyname($host);
echo "http://" . $ip . "/AD/smsapi.php?passkey=" . urlencode($val['passkey']) . "&app=" . urlencode($val['application']) . "&group=" . urlencode($val['target_group']) . "&medium=telegram" . "&body=" ;?></td>
                        <td align="center">
							<a href="edit-group.php?editId=<?php echo $val['target_group'];?>" class="text-primary"> Edit</a> | 
							<a href="delete-group.php?delId=<?php echo $val['target_group'];?>" class="text-danger" onClick="return confirm('Are you sure to delete this user?');"> Delete</a>
						<!--	<a href="send-message.php?passkey=<?php echo $val['passkey'];?>&app=<?php echo $val['application']?>&group=<?php echo $val['target_group'];?>&group=<?php echo $val['target_group'];?>" class="text-primary"> Message</a>
						-->
						</td>
						

					</tr>
					<?php 
						}
					}else{
					?>
					<tr><td colspan="6" align="center">No Record(s) Found!</td></tr>
					<?php } ?>
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->
		
	</div>
	
	<script src="include/jquery.min.js"></script>

	<script src="include/popper.min.js"></script>


    <script src="include/bootstrap.min.js"></script>
	<script src="include/jquery.caret.js"></script>
	<script src="include/jquery-ui.min.js" ></script>
    <script>
		$(document).ready(function() {
			jQuery(function($){
				  var input = $('[type=tel]')
				  input.mobilePhoneNumber({allowPhoneWithoutPrefix: '+1'});
				  input.bind('country.mobilePhoneNumber', function(e, country) {
					$('.country').text(country || '')
				  })
			 });
			 
			 //From, To date range start
			var dateFormat	=	"yy-mm-dd";
			fromDate	=	$(".fromDate").datepicker({
				changeMonth: true,
				dateFormat:'yy-mm-dd',
				numberOfMonths:2
			})
			.on("change", function(){
				toDate.datepicker("option", "minDate", getDate(this));
			}),
			toDate	=	$(".toDate").datepicker({
				changeMonth: true,
				dateFormat:'yy-mm-dd',
				numberOfMonths:2
			})
			.on("change", function() {
				fromDate.datepicker("option", "maxDate", getDate(this));
			});
			
			
			function getDate(element){
				var date;
				try{
					date = $.datepicker.parseDate(dateFormat,element.value);
				}catch(error){
					date = null;
				}
				return date;
			}
			//From, To date range End here	
			
		});
	</script>
</body>
</html>
