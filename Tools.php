<?php
 
$targetfolder = "D:/xampp/htdocs/wishlist_1/resources/thumbnails/";
 
//Usage of basename() function
 
$targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;
 
if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
 
{
 
echo "The file ". basename( $_FILES['file']['name']). " is uploaded";
 
}
 
else {
 
echo "Problem uploading file";
 
}
 
?>


<html>
 
<head>
 
<title>A simple example of uploading a file using PHP script</title>
 
</head>
 
<body>
 
<b>Simple example of uploading a file</b><br />
 
Choose a file to be uploaded<br />
 
<form action="Tools.php" method="post" enctype="multipart/form-data">
 
<input type="file" name="file"  />
 
<br />
 
<input type="submit" value="Upload" />
 
</form>
 
</body>
 
</html>