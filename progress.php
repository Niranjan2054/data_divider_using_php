<!DOCTYPE html>
<html>
<head>
	<title>File Form</title>
	<link rel="stylesheet" href="assest/css/style.css">
	<link rel="stylesheet" type="text/css" href="assest/css/bootstrap.min.css">
	<link rel="icon" type="image/*" href="https://svn.apache.org/repos/asf/lucene.net/tags/Lucene.Net_3_0_3_RC2_final/branding/logo/favicon.ico">
</head>
<body class="back">
	<?php 
		ob_start();
		session_start();
		if ($_SESSION['original_file_name']=='') {
			@header('location: form_file.php');
			exit;
		}
		//$dir='file_'.time().rand(0,999);
		$location = "result";//.$dir;
		if (!is_dir($location)) {
			mkdir($location,0777,true);
		}
	?>
	<div class="container">
		<div class="row margin">
			<h1 class="ha text-center">Grouping of Data...</h1>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<h2 class="color_white text-center">Grouping of data is already carried...</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<?php
					$txt_file_name = 1;
					$_total_data=0; //total data in the file..
					$_total_count_data=0; //total processed data for percentage calculation..
					$count_data = 0; //another count variable for changeing file no...
					$invalid = fopen("invalid.txt", "w");
					$file = fopen($_SESSION['file_name'], 'r');
					while (!feof($file)) {
						$data=fgets($file);
						$_total_data++;
					}
					fclose($file);
					$file=fopen($_SESSION['file_name'], "r");
					chdir($location);
					$files = array();
					while (!feof($file)) {
						$valid = fopen("$txt_file_name.txt", "a");
						$data = fgets($file);	
						$data = filter_var($data, FILTER_SANITIZE_EMAIL);		
						if(filter_var($data,FILTER_VALIDATE_EMAIL)!=''){
							fwrite($valid, $data."\n");		
							$count_data++;
							$_total_count_data++;
							if($count_data==$_SESSION['no_of_data']){
								$txt_file_name++;
								$count_data=0;
								$files[]="$txt_file_name.txt";
							}

						}else{
							fwrite($invalid,$data."\n");
						}
					}
				?>
			</div>
		</div>
		<div class="row">
			<?php 
				$zipname = 'file.zip';
				$zip = new ZipArchive;
				$zip->open($zipname, ZipArchive::CREATE);
				foreach ($files as $file) {
				  $zip->addFile($file);
				}
				$zip->close();
			 ?>
			<h4 class="color_white"><a href="result/file.zip" target="_blank">download files</a></h4>
		</div>
	</div>	
</body>
</html>