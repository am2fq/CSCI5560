<?php include_once('config2.php');
if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
	if($application==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=app');
		exit;
	}elseif($target_group==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=trgt');
		exit;
	}else{
		
		$userCount	=	$db->getQueryCount('users','Phone');
		if($userCount[0]['total']<1000){
			$data	=	array( //Col => varaiable from request
				'Name'=>$Name,
				'Phone'=>$Phone,
				'chat_id'=>"",
				'application'=>$application,
				'target_group'=>$target_group,

						);
			try{
			$insert	=	$db->insert('users',$data);
			} catch(Exception $e){
				header('location:'.$_SERVER['PHP_SELF'].'?msg=Failed');
				
			}
			
			if($insert){
				header('location:'.$_SERVER['PHP_SELF'].'?msg=Success');
				exit;
			}else{
				header('location:'.$_SERVER['PHP_SELF'].'?msg=Failed');
				
			}
		}else{
			header('location:'.$_SERVER['PHP_SELF'].'?msg=security');
			exit;
		}
	}
}
?>

<!doctype html>

<html>

<head>

	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Add Recepients</title>

	<style>
body {
  background-image: url('photo.jpeg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
}
</style>


	<link rel="stylesheet" href="include/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="include/all.css" rel="stylesheet">
	<!-- Global site tag (gtag.js) - Google Analytics -->



</head>



<body>

	

	<div class="bg-light border-bottom shadow-sm sticky-top">

		<div class="container">

			<header class="blog-header py-1">

				

			</header>

		</div> <!--/.container-->

	</div>

	

	

   	<div class="container">

		<h1 style="color:white;" >Add Recepients</h1>

		<?php

		if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="app"){

			echo	'<div class="alert alert-danger"> App name is mandatory field!</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="trgt"){

			echo	'<div class="alert alert-danger">Target Group is mandatory field!</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="Failed"){

			echo	'<div class="alert alert-danger">Record not added <strong>Duplicate entry</strong></div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="Success"){

			echo	'<div class="alert alert-success">Record added successfully</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="security"){

			echo	'<div class="alert alert-danger"> Please delete a user and then try again <strong>We set limit for security reasons!</strong></div>';

		}

		?>

		<div class="card">

			<div class="card-header"> <strong>Add User</strong> <a href="browse-users.php" class="float-right btn btn-dark btn-sm"> Browse Users</a></div>

			<div class="card-body">

				

				<div class="col-sm-6">

					<h5 class="card-title">Fields with <span class="text-danger">*</span> are mandatory!</h5>

					<form method="post">

						<div class="form-group">

							<label>User Name <span class="text-danger">*</span></label>

							<input type="text" name="Name" id="Name" class="form-control" placeholder="Enter user name" required>

						</div>

						<div class="form-group">

							<label>App Name <span class="text-danger">*</span></label>
			                            <select name="application" id="application" class="form-control">
                                   <?php
                                    include_once('config2.php');
                                    $data = $db->getAllRecords('api', 'DISTINCT application','','','');
                                    foreach ($data as $row) {
                                        echo '<option>' . $row['application']. '</option>';
                                    }
                                    ?>
									
                                </select>
	

					<!--		<input type="text" name="application" id="application" class="form-control" placeholder="Enter App Name" required>
-->

						</div>
						<div class="form-group">

							<label>Group Name <i>(Its a Foreign Key, select from given options)</i><span class="text-danger">*</span></label>
					<select name="target_group" id="target_group" class="form-control">
                                    
									<?php
                                    include_once('config2.php');
                                    $data = $db->getAllRecords('api', 'DISTINCT target_group','','','');
									var_dump($data);
                                    foreach ($data as $row) {
                                        echo '<option>' . $row['target_group']. '</option>';
                                    }
                                    ?>
								
                                </select>


				<!--			<input type="text" name="target_group" id="target_group" class="form-control" placeholder="Enter Group Name" required>
-->

						</div>
						

						<div class="form-group">

							<label>Mobile Number <span class="text-danger">*</span></label>

							<input type="text"  class="tel form-control" name="Phone" id="Phone" placeholder="Enter user phone" required>

						</div>

						<div class="form-group">

							<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"> Add User</button>

						</div>

					</form>

				</div>

			</div>

		</div>

	</div>

	

	<script src="include/jquery.min.js"></script>

	<script src="include/popper.min.js"></script>


    <script src="include/bootstrap.min.js"></script>
	<script src="include/jquery.caret.js"></script>
	<script>
		$(document).ready(function() {
		jQuery(function($){
			  var input = $('[type=tel]')
			  input.mobilePhoneNumber({allowPhoneWithoutPrefix: '+1'});
			  input.bind('country.mobilePhoneNumber', function(e, country) {
				$('.country').text(country || '')
			  })
			 });
		});
	</script>

    

</body>

</html>
