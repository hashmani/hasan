<?php

if(isset($_POST['btn_upl']))
{
	$FileName= $_FILES['user_file']['name'];
	$FileSize= $_FILES['user_file']['size'];
	$FileType= $_FILES['user_file']['type'];
	$FileError= $_FILES['user_file']['error'];
	$FileTempName= $_FILES['user_file']['tmp_name'];
	
	if($FileError == 0)
	{
		$entension=explode(".",$FileName);
		$entension=end($entension);
		$entension = strtolower($entension);
		$allowedExt=array("jpg","jpeg","png","docx","txt","mp3","mp4","gif");
		
		if(in_array($entension,$allowedExt))
		{
			$newfilename= rand(123456789,999999999)."_".rand(12345,99999).".".$entension;
			
			//$newname= time().".".$entension;
			$check=move_uploaded_file($FileTempName,"uploads/".$newfilename);
			if($check)
			{
				$path="uploads/".$newfilename;
				if(in_array($entension,array("jpg","jpeg","png","gif","bmp")))
				{
					echo '<p><img src='.$path.' width="200"  height="200"/></p>';
				}
				else if(in_array($entension,array("mp3","mp4","avi","flv","3gp")))
				{
					echo '<p>To Download (Right Click snd save as)</p>';
					echo '<video src='.$path.' type="video/mp4" controls="controls" target="_blank">Download Here</video>';
				}
				else if(in_array($entension,array("mp3")))
				{
					echo '<p>To Download (Right Click snd save as)</p>';
					echo '<audio src='.$path.' type="video/mp3" controls="controls" target="_blank">Download Here</audio>';
				}
				else if(in_array($entension,array("docx","txt","pdf")))
				{
					echo '<p>To Download (Right Click snd save as)</p>';
					echo '<a href='.$path.' target="_blank">Download Here</a>';
				}
			}
			else
			{
				echo "<script> alert ('Error while uploading file'); </script>";
			}
			
		}
		else
		{
			echo "<script> alert ('File type is supported'); </script>";
		}
		
	}
	
	else
	{
		echo "<script> alert ('File has error'); </script>";
	}

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <h2 align="center">FILE UPLOADING
  </h2>
  <p align="center">
    <label for="file_user"></label>
    <input type="file" name="user_file" id="file_user" multiple="multiple" />
    <input type="submit" name="btn_upl" id="btn_upl" value="Upload" />
  </p>
</form>
</body>
</html>