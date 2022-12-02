<?php include_once('config2.php');
if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
	if($passkey==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=PASS');
		exit;
	}elseif($Valid==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=valid');
		exit;
	}elseif($target_group==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=target');
		exit;
    }elseif($application==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=app');
		exit;
	} elseif($Date==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=date');
		exit;
	}
    else{
		
		$userCount	=	$db->getQueryCount('api','target_group');
		if($userCount[0]['total']<1){
			
			$data	=	array(
					'Expiry_date' => $Date,
					'passkey'=>$passkey,
					'Valid'=>$Valid,
					'application'=>$application,
					'target_group'=>$target_group,

						);
			try {
			$insert	=	$db->insert('api',$data);
			} catch(Exception $e) {
				header('location:'.$_SERVER['PHP_SELF'].'?msg=integrity');
				exit;
			}
			if($insert){
				header('location:'.$_SERVER['PHP_SELF'].'?msg=success');
				exit;
			}else{
				header('location:'.$_SERVER['PHP_SELF'].'?msg=integrity');
				exit;
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

	<title>5560 Add Group</title>

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

		<h1 style="color:white;">Add a new group</h1>

		<?php

		if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="PASS"){

			echo	'<div class="alert alert-danger"> Passkey is mandatory field!</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="valid"){

			echo	'<div class="alert alert-danger"> Validity is mandatory field!</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="target"){

			echo	'<div class="alert alert-danger"> Target Group is mandatory field!</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="app"){

			echo	'<div class="alert alert-danger"> Application name is mandatory field!</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="success"){

			echo	'<div class="alert alert-success"> Record added successfully!</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="security"){

			echo	'<div class="alert alert-danger"> Please delete a user and then try again <strong>We set limit for security reasons!</strong></div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="integrity"){
			echo	'<div class="alert alert-danger"><strong>Integrity Constraint violation</strong> Check for duplicate entries or data format</div>';
		}
		elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="date"){
			echo	'<div class="alert alert-danger"><strong>Put an expiry date</div>';
		}

		?>

		<div class="card">

			<div class="card-header"><i ></i> <strong>Add Group</strong> <a href="browse-groups.php" class="float-right btn btn-dark btn-sm"> Browse Groups</a></div>

			<div class="card-body">

				

				<div class="col-sm-6">

					<h5 class="card-title">Fields with <span class="text-danger">*</span> are mandatory!</h5>

					<form method="post">

						<div class="form-group">

							<label>Expiry Date <span class="text"></span></label>

							<input type="text" name="Date" id="Date" class="form-control" placeholder="YYYY-mm-dd">

						</div>
                        <div class="form-group">

                            <label>Validity <span class="text-danger">*</span></label>

                            <input type="number" name="Valid" id="Valid" maxlength="1" class="form-control" placeholder="Enter 0/1">

                            </div>

						<div class="form-group">

							<label>App Name <span class="text-danger">*</span></label>

							<input type="text" name="application" id="application" class="form-control" placeholder="Enter App Name">

						</div>
                        <div class="form-group">

                            <label>API Passkey <span class="text-danger">*</span></label>

                            <input type="text" name="passkey" id="passkey" class="form-control" placeholder="Enter Passkey" required>

                        </div>
						<div class="form-group">

							<label>Group Name <span class="text-danger">*</span></label>

							<input type="text" name="target_group" id="target_group" class="form-control" placeholder="Enter Group Name" required>

						</div>
						


						<div class="form-group">

							<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"> Add Group</button>

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
<!--	<script src="https://www.solodev.com/_/assets/phone/jquery.mobilePhoneNumber.js"></script> -->
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