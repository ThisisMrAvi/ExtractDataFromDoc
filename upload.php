<?php
//Linking Extract file.
require ("extract.php");
	
	error_reporting(E_ERROR);
	date_default_timezone_set('Asia/Kolkata');
	$msg="";
	//Establish connection with database.
	$con = mysqli_connect("localhost", "root", "","upload") or die("db connection error");

	if (isset($_POST['upload'])) {
		if(!empty($_POST['name'] || (!empty($_POST['email'])))){
			//collecting all variables after upload.
			$allowedExt = array("doc", "docx");
			$name = $_POST['name'];
			$email = $_POST['email'];
			$filename = $_FILES['file']['name'];
			$tempfile = $_FILES['file']['tmp_name'];
			$text = $_POST['text']; 
			$destination = "docs/".$filename;
			$extension = end(explode(".",$filename));
			//Converting files to text.
			$docConvert = new DocxConversion($destination);
			$docText= $docConvert->convertToText();
			$emailID = $docConvert->extractEmail($docText);
			$phone = $docConvert->extractMobile($docText);

			if(in_array($extension, $allowedExt)){
				$query = "INSERT into up_files(name, email, file, text) values ('".$name."', '".$email."', '".$file."', '".$text."')";

				mysqli_query($con, $query) or die("querry error");

				if (move_uploaded_file($tempfile, $destination)) {
					$msg = "File uploaded successfully";
				}
				else{
					$msg = "something went wrong ";
				}
			}
			else
			{
				$msg = "File format not supported";
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body style="margin-top: 100px ">
	<div class="container">
		<div class="jumbotron">
			<h2 id="success"> <?php echo $msg; ?> </h2><br><br>
			<label>Email: </label>
			<p id="emailID"> <?php echo $emailID[0][0];
				//var_dump($emailID);
			 ?> </p><br>
			<label>Mobile no: </label>
			<p id="phone"> <?php echo $phone[0][0]; 
				//var_dump($phone);
			?> </p>
			<br>
			<br>
			<br>
			<!-- To dispplay whole document
			<p id="phone"> <?php echo $docText; ?> </p>
			-->
		</div>
	</div>
</body>