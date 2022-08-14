<?php 
include "koneksi.php";
$id = $_GET['id'];
if(empty($_GET['id']))
{
	header("location:index.php");
}
elseif(!empty($_GET['id']))
{
$sql = mysqli_query($koneksi, "SELECT * FROM my_file WHERE id = '$id'");
$data = mysqli_fetch_assoc($sql);
$pile = $data['file_name'];
unlink("pile/".$pile);
$sqli = mysqli_query($koneksi, "DELETE FROM my_file WHERE id = '$id'");
if($sqli)
	{
		echo "<script>alert('File Success Removed!!');</script>";
		header("location:index.php");
	}
}
?>