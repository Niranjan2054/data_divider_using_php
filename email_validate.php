<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

</body>
</html>
<?php  
	ob_start();
	session_start();
	ini_set('max_execution_time', 3000); //3000 seconds = 50 minutes
	echo "<pre>";
	print_r($_FILES);
	$accepted_ext = array('txt');
	if(isset($_POST) && !empty($_POST['no_of_data'])){
		if(($_FILES['email_file']['size']!=0)){
			$location ='uploads/text/';
			if(is_dir($loation)){
				rddir($location);
			}
			if(!is_dir($location)) {
				mkdir($location,0777,true);
			}
			if(!$_FILES['email_file']['error']){
				$ext = pathinfo($_FILES['email_file']['name'],PATHINFO_EXTENSION);
				$file_name = "text-".time().rand(0,9).'.'.$ext;
				if(in_array(strtolower($ext), $accepted_ext)){
					if($_FILES['email_file']['size']<=(5000000)){
						echo ($_FILES['email_file']['size']+1);
						echo "string";
						$sucess = move_uploaded_file($_FILES['email_file']['tmp_name'], $location.$file_name);
						$_SESSION['file_name']=$location.$file_name;
						$_SESSION['original_file_name']=$_FILES['email_file']['name'];
						$_SESSION['no_of_data'] =$_POST['no_of_data'];
						@header('location: progress.php');
					}else{
						$_SESSION['error']= "File size must be less than 5mb.";
						@header('location: form_file.php');
						exit;
					}
				}else{
					$_SESSION['error'] = "File format not supported.";
					@header('location: form_file.php');
					exit;
				}
			}else{
				$_SESSION['error']= "Error occured during uploading.";
				@header('location: form_file.php');
				exit;
			}	
		}else{
			$_SESSION['error'] = "Upload text file first...";
			@header('location: form_file.php');
			exit;
		}
	}else{
		$_SESSION['error']="No of data is required...";
		@header('location: form_file.php');
	}
//	@header('location: progress.php')
?>

<!-- <?php
	$txt_file_name = 1;
	$count_data = 0;
	$invalid = fopen("invalid.txt", "w");
	for($i=0;$i<$count_uploaded;$i++){
		$file=fopen($file_names[$i], "r");
		while (!feof($file)) {
			$valid = fopen("$txt_file_name.txt", "a");
			$email = fgets($file);	
			$email = filter_var($email, FILTER_SANITIZE_EMAIL);		
			if(filter_var($email,FILTER_VALIDATE_EMAIL)!=''){
				fwrite($valid, $email."\n");		
				$count_data++;
				if($count_data==$_POST['no_of_data']){
					$txt_file_name++;
					$count_data=0;
				}

			}else{
				fwrite($invalid,$email."\n");
			}
		}

	}
?> -->