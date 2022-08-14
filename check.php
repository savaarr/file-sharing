<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Check File Encrypt</title>
</head>
<body>
<?php
if(isset($_POST['check']))
{
$id = $_GET['id'];
include "koneksi.php";
$encrypt = md5($_POST['encrypt']);
$rows = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM my_file WHERE id = '$id' AND file_encrypt = '$encrypt'"));
if($rows > 0)
{
	$id = $_GET['id'];
	include "koneksi.php";
	$row = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM my_file WHERE id = '$id'"));	
	$file = $row['file_name'];
	header("location:download.php?file=$file");
}elseif(header("location;index.php")){

}else
{
	echo "<p style='color:red'>Password incorrect</p>";
}
}
?>
    <form action="" method="POST">
	<input type="text" name="encrypt" placeholder="Encrypt enter ..." autocomplete="off" autofocus required><p>
	<input type="submit" name="check" hidden>	
</form>
<a style='text-decoration:none;color:green' href='index.php'">Back to home</a>

</body>
</html>