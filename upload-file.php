<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Upload New File</title>
</head>
<body>
<h2><a style='text-decoration:none;color:red' href='index.php'>Upload New File</a></h2>
<?php 
include "koneksi.php";
if(isset($_POST['upload']))
{
	date_default_timezone_set("Asia/Jakarta");
    $time = date("d M Y - H:i");
    $fileName = $_FILES['file']['name'];
	$file = round(microtime(true))."-".$fileName;
	$tmp = $_FILES['file']['tmp_name'];
	$path = "pile/".$file;
	$limit = 10 * 1024 * 1024;
	$accept = array('jpg', 'png', 'jpeg', 'ico', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'zip', 'rar');
	$ekstensi = explode('.', $fileName);
	$ekstensi = strtolower(end($ekstensi));
	$password = md5($_POST['password']);
	if(!in_array($ekstensi, $accept))
	{
		echo "<script>";
		echo "alert('Ekstensi file tidak diizinkan!')";
		echo "</script>";
	}
	elseif($size > $limit)
	{
		echo "<script>";
		echo "alert('Ukuran file terlalu besar!')";
		echo "</script>";
	}
	else
	{
	move_uploaded_file($tmp, $path);
	include "koneksi.php";
	$save = mysqli_query($koneksi, "INSERT INTO my_file VALUES ('', '$file','$password','$time')");
	if($save)
	{
		echo "<script>";
		echo "alert('Upload file berhasil!')";
		echo "</script>";
		header("location:index.php");
	}
	else
		{
		echo "<script>";
		echo "alert('Upload file gagal!')";
		echo "</script>";
		header("location:upload-file.php");
	}
}
}
?>

<form action="" method="POST" enctype="multipart/form-data">	
	<input type="file" name="file" required><p>
	<input type="text" name="password" placeholder="Encrypt" autocomplete="off" required><p>
	<input type="submit" name="upload" value="Upload">
	</form>
</body>
</html>