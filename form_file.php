<!DOCTYPE html>
<html>
<head>
	<title>File Form</title>
	<link rel="stylesheet" href="assest/css/style.css">
	<link rel="stylesheet" type="text/css" href="assest/css/bootstrap.min.css">
	<link rel="icon" type="image/*" href="https://svn.apache.org/repos/asf/lucene.net/tags/Lucene.Net_3_0_3_RC2_final/branding/logo/favicon.ico">
</head>
<body class="back">
	<div class="container">
		<div class="row">
			<div class="col-md-12 mar">
				<h1 class="text-center h11">Upload and Download with group of data:</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="row">
					<form action="email_validate.php" method="post" class="form form-horizontal" enctype="multipart/form-data">
						<?php 
							session_start();
							if (!empty($_SESSION['error'])) {
								echo '<p class="color_white">'.$_SESSION['error'].'</p>';
								unset($_SESSION['error']);
							}
						 ?>
						<div class="form-group">
							<label for="" class="col-md-12"><h3 class="color_white"><strong>No. of data in each file:</strong></h3></label>
							<div class="col-md-8">
								<input type="number" required name="no_of_data" class="form-control">
							</div>
						</div>
						<div class="form-group"><br>
							<label for="" class="col-md-12"><h3 class="color_white"><strong>Enter files containing email:</strong></h3></label>
							<div class="col-md-12">
								<input type="file" name="email_file" accept="text/plain" required  class="center"> 
							</div>
						</div>
						<div class="from-group">
							<div class="col-md-2"></div>
							<div class="col-md-10">
								<button class="btn btn-success" type="submit"><strong class="font_25">Submit</strong></button>
							</div>
						</div>
					</form>
				</div>		
			</div>
		</div>
	</div>
</body>
</html>
