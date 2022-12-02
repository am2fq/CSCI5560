<?php include_once('config2.php');?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Browse Users</title>
	
	<style>
body {
  background-image: url('DB.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
}
table { background-color: #ff0000; }
tr { background-color: yellow; }
td { background-color: white; }
</style>
	<link rel="stylesheet" href="include/jquery-ui.css" type="text/css">
    <link rel="stylesheet" href="include/bootstrap.min.css" >
    <link rel="stylesheet" href="include/all.css" >
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	
	
	
	<?php
	$condition	=	'';
	if(isset($_REQUEST['Name']) and $_REQUEST['Name']!=""){
		$condition	.=	' AND Name LIKE "%'.$_REQUEST['Name'].'%" ';
	}
	if(isset($_REQUEST['Phone']) and $_REQUEST['Phone']!=""){
		$condition	.=	' AND Phone LIKE "%'.$_REQUEST['Phone'].'%" ';
	}
	if(isset($_REQUEST['chat_id']) and $_REQUEST['chat_id']!=""){
		$condition	.=	' AND chat_id LIKE "%'.$_REQUEST['chat_id'].'%" ';
	}
	if(isset($_REQUEST['application']) and $_REQUEST['application']!=""){
		$condition	.=	' AND application LIKE "%'.$_REQUEST['application'].'%" ';
	}
	if(isset($_REQUEST['target_group']) and $_REQUEST['target_group']!=""){
		$condition	.=	' AND target_group LIKE "%'.$_REQUEST['target_group'].'%" ';
	}
	
	
	$userData	=	$db->getAllRecords('users','*',$condition,'');
	?>
   	<div class="container">
		<h1 style="color:white;" >Browse Users</h1>
		<?php
			if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="del-success"){
			echo	'<div class="alert alert-success">Record Deleted</div>';
		}
		?>
		<div class="card">
			<div class="card-header"> <strong></strong> 
			<a href="add-users.php" class="float-center btn btn-dark btn-sm"> Add Users</a>
			 <strong></strong> 
			<a href="browse-groups.php" class="float-center btn btn-dark btn-sm"> Browse Groups</a>
		</div>

			<div class="card-body">
				<?php
				//Err messages not required
				?>
				<div class="col-sm-12">
					<h5 class="card-title"> Find User</h5>
					<form method="get">
						<div class="row">
							<div class="col-sm-2">
								<div class="form-group">
									<label>Name</label>
									<input type="text" name="Name" id="Name" class="form-control" value="<?php echo isset($_REQUEST['Name'])?$_REQUEST['Name']:''?>" placeholder="Enter user name">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>Phone</label>
									<input type="text" name="Phone" id="Phone" class="form-control" value="<?php echo isset($_REQUEST['Phone'])?$_REQUEST['Phone']:''?>" placeholder="Enter Phone number">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>chat id</label>
									<input type="text" name="chat_id" id="chat_id" class="form-control" value="<?php echo isset($_REQUEST['chat_id'])?$_REQUEST['chat_id']:''?>" placeholder="Enter ChatID">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>Application</label>
									<input type="text" name="application" id="application" class="form-control" value="<?php echo isset($_REQUEST['application'])?$_REQUEST['application']:''?>" placeholder="Enter App Name">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label>Group</label>
									<input type="text" name="target_group" id="target_group" class="form-control" value="<?php echo isset($_REQUEST['target_group'])?$_REQUEST['target_group']:''?>" placeholder="Enter Group Name">
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
						<th>Name</th>
						<th>Phone</th>
						<th>Chat ID</th>
						<th>Application</th>
						<th>Target Group</th>
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
						<td><?php echo $val['Name'];?></td>
						<td><?php echo $val['Phone'];?></td>
						<td><?php echo $val['chat_id'];?></td>
						<td><?php echo $val['application'];?></td>
						<td><?php echo $val['target_group'];?></td>
					
						<td align="center">
							<a href="edit-users.php?Name=<?php echo $val['Name'];?>&Phone=<?php echo $val['Phone'];?>&app=<?php echo $val['application'];?>&target=<?php echo $val['target_group'];?>" class="text-primary"> Edit</a> | 
							<a href="delete.php?Name=<?php echo $val['Name'];?>&Phone=<?php echo $val['Phone'];?>&app=<?php echo $val['application'];?>&target=<?php echo $val['target_group'];?>" class="text-danger" onClick="return confirm('Are you sure to delete this user?');"> Delete</a>
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
