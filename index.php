<?php
session_start();
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
<body>
	<div class="container">
		<h2 style="padding-left: 200px;">Upload your document file:</h2><br><br><br>
		<div class="row">
			<!-- Form to take input from user -->
			<form id="upload" method="post" enctype="multipart/form-data" class="form_horizontal col-md-4 col-md-offset-2" action="upload.php">
				<div class="form-group">
					<input type="text" class="form-control" name="name" required="true" placeholder="Enter Name">
				</div>
				<div class="form-group">
					<input type="email" class="form-control" name="email" required="true" placeholder="Enter email">
				</div>
				<div class="form-group">
					<input type="file" class="form-control" name="file" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document">
				</div>
				<div class="form-group">
					<textarea name="text" class="form-control" placeholder="Write something about your file"></textarea>
				</div>
				<button type="submit" name="upload" class="btn btn-primary" onclick="readFile()">Upload</button>
			</form>
			<!-- Form Ends-->
		</div>
	</div>
</body>