<?php include_once('config2.php');

if(isset($_REQUEST['Name']) !="" and $_REQUEST['Phone'] !="" and $_REQUEST['app'] !="" and $_REQUEST['target']!=""){
	$Phone = (substr($_REQUEST['Phone'], 0, 1) == ' ')? '+'. trim($_REQUEST['Phone']):$_REQUEST['Phone'];
	//$row	=	$db->getAllRecords('users','*',' AND Name="'.$_REQUEST['Name'].'" AND Phone="+'. $Phone.'" AND application="'.$_REQUEST['app'].'" AND target_group="'.$_REQUEST['target'].'"');
	$row	=	$db->getAllRecords('users','*',' AND Name="'.$_REQUEST['Name'].'" AND Phone="'. $Phone.'" AND application="'.$_REQUEST['app'].'" AND target_group="'.$_REQUEST['target'].'"');
var_dump($row);
}

if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
	if($Name==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=Name');
		exit;
	}elseif($Phone==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=Phone');
		exit;
	}
	elseif($application==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=app');
		exit;
	}elseif($target_group==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=target');
		exit;
	}
	$data	=	array(
					'Name'=>$Name,
					'Phone'=>$Phone,
					'chat_id'=>$row[0]['chat_id'],
					'application'=>$application,
					'target_group'=>$target_group,

					);
	$update	=	$db->update('users',$data,array('Name'=>$Name,
						'Phone'=>$Phone,
					'chat_id'=>$row[0]['chat_id'],
					'application'=>$application,
					'target_group'=>$target_group,
	
	));
	if($update){
		header('location: browse-users.php?msg=rus');
		exit;
	}else{
		header('location: browse-users.php?msg=rnu');
		exit;
	}
}
?>
<!doctype html>
<html >
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Edit User</title>
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
<!--
	<script src="include/html5shiv.min.js"></script>
	<script src="include/respond.min.js"></script>
-->
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
		<h1 style="color:white;">Edit User</a></h1>
		<?php
		if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="Name"){
			echo	'<div class="alert alert-danger">User name is mandatory field!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="Phone"){
			echo	'<div class="alert alert-danger">Phone number is mandatory</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="app"){
			echo	'<div class="alert alert-danger"> App name is mandatory field!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ras"){
			echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record added successfully!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="target"){
			echo	'<div class="alert alert-danger">Target Group name mandatory</div>';
		}
		?>
		<div class="card">
			<div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Add User</strong> <a href="browse-users.php" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-globe"></i> Browse Users</a></div>
			<div class="card-body">
				
				<div class="col-sm-6">
					<h5 class="card-title">Fields with <span class="text-danger">*</span> are mandatory!</h5>
					<form method="post">
						<div class="form-group">
							<label>User Name <span class="text-danger">*</span></label>
							<input type="text" name="Name" id="Name" class="form-control" value="<?php echo $row[0]['Name']; ?>" placeholder="Enter user name" required>
						</div>
						<div class="form-group">
							<label>MSISDN <span class="text-danger">*</span></label>
							<input type="text"  name="Phone" id="Phone" class="form-control" value="<?php echo $row[0]['Phone']; ?>" placeholder="Enter Phone" required>
						</div>
<!--						<div class="form-group">
							<label>Chat ID <span class="text-danger">*</span></label>
							<input type="text" name="chat_id" id="chat_id" class="form-control" value="<?php echo $row[0]['chat_id']; ?>" placeholder="Enter Chat ID" required>
						</div>
-->
						<div class="form-group">
							<label>Application <span class="text-danger">*</span></label>
					<select name="application" id="application" class="form-control">
                                    <?php
                                    include_once('config2.php');
                                    $data = $db->getAllRecords('api', 'DISTINCT application','','','');
                                    foreach ($data as $row) {
                                        echo '<option>' . $row['application']. '</option>';
                                    }
                                    ?>
                                </select>
	
					<!--		<input type="text" name="application" id="application" class="form-control" value="<?php echo $row[0]['application']; ?>" placeholder="Enter App name" required>
-->
						</div>
						<div class="form-group">
							<label>Group <span class="text-danger">*</span></label>
					<select name="target_group" id="target_group" class="form-control">
                                    <?php
                                    include_once('config2.php');
                                    $data = $db->getAllRecords('api', 'DISTINCT target_group','','','');
                                    foreach ($data as $row) {
                                        echo '<option>' . $row['target_group']. '</option>';
                                    }
                                    ?>
                                </select>
	
				<!--			<input type="text" name="target_group" id="target_group" class="form-control" value="<?php echo $row[0]['target_group']; ?>" placeholder="Enter Group name" required>
-->
						</div>
						<div class="form-group">
						<!--	<input type="hidden" name="editId" id="editId" value="<?php echo $_REQUEST['editId']?>"> -->
							<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"> Update User</button>
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
