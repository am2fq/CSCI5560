<?php include_once('config2.php');
if(isset($_REQUEST['editId']) and $_REQUEST['editId']!=""){
	$row	=	$db->getAllRecords('api','*',' AND target_group="'.$_REQUEST['editId'].'"');
}

if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
	
	$data	=	array(
					'Expiry_Date'=>$Date,
					'passkey'=>$passkey,
					'Valid'=>$Valid,
					'application'=>$application,
					'target_group'=>$target_group,

					);
	try {
	$update	=	$db->update('api',$data,array('target_group'=>$editId));
	} catch (Exception $e) {
		header('location:'.$_SERVER['PHP_SELF'].'?msg=integrity&editId='.$_REQUEST['editId']);
	}
	if($update){
		header('location: browse-groups.php?msg=edit-success');
		exit;
	}else{
		header('location:'.$_SERVER['PHP_SELF'].'?msg=integrity&editId='.$_REQUEST['editId']);
		
	}
}
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Edit Group</title>
	<style>
body {
  background-image: url('photo.jpeg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
}
</style>
	
	<link rel="stylesheet" href="include/jquery-ui.css" type="text/css">
    <link rel="stylesheet" href="include/bootstrap.min.css" >
    <link rel="stylesheet" href="include/all.css" >
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	
	<div class="bg-light border-bottom shadow-sm sticky-top">
		<div class="container">
			<header class="blog-header py-1">
				
			</header>
		</div> <!--/.container-->
	</div>
	
	
   	<div class="container">
		<h1 style="color:white;">Edit Group</h1>
		<?php
		if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="integrity"){
			echo	'<div class="alert alert-danger">Check for integrity constraints</div>';
		
		}
		?>
		<div class="card">
			<div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Add Group</strong> <a href="browse-groups.php" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-globe"></i> Browse groups</a></div>
			<div class="card-body">
				
				<div class="col-sm-6">
					<h5 class="card-title">Fields with <span class="text-danger">*</span> are mandatory!</h5>
					<form method="post">
						<div class="form-group">
							<label>Expiry Date <span class="text-danger">*</span></label>
							<input type="text" name="Date" id="Date" class="form-control" value="<?php echo $row[0]['Expiry_date']; ?>" placeholder="Enter Date" required>
						</div>
						<div class="form-group">
							<label>passkey <span class="text-danger">*</span></label>
							<input type="text" name="passkey" id="passkey" class="form-control" value="<?php echo $row[0]['passkey']; ?>" placeholder="Enter passkey" required>
						</div>
						<div class="form-group">
							<label>Valid <span class="text-danger">*</span></label>
							<input type="text" name="Valid" id="Valid" maxlength="1" class="form-control" value="<?php echo $row[0]['Valid']; ?>" placeholder="Enter 0/1" required>
						</div>
						<div class="form-group">
							<label>Application Name <span class="text-danger">*</span></label>
							<input type="text" name="application" id="application" class="form-control" value="<?php echo $row[0]['application']; ?>" placeholder="Enter app name" required>
						</div>
						<div class="form-group">
							<label>Target group <span class="text-danger">*</span></label>
							<input type="text" name="target_group" id="target_group" class="form-control" value="<?php echo $row[0]['target_group']; ?>" placeholder="Enter app name" required>
						</div>
						<div class="form-group">
							<input type="hidden" name="editId" id="editId" value="<?php echo $_REQUEST['editId']?>">
							<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-edit"></i> Update User</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
    
	<script src="include/jquery.min.js"></script>

<script src="include/popper.min.js"></script>


<script src="include/bootstrap.min.js"></script>
</body>
</html>