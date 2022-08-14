<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>File Sharing</title>
</head>
<body>
<center>
<h2>File Sharing</h2>
<table border="1" cellspacing="0" cellpadding="5" align="center" width="100%">
<tr>
	<th>No</th>
	<th>File</th>
	<th>Time</th>
	<th>Remove</th>
</tr>
<?php 
include "koneksi.php";
$batas = 4;
$halaman = @$_GET['halaman'];
if(empty($halaman))
{
	$posisi = 0;
	$halaman = 1;
}
else
{
	$posisi = ($halaman-1) * $batas;
}
$sql = mysqli_query($koneksi, "SELECT * FROM my_file LIMIT $posisi, $batas");
$no = $posisi+1;
while($row = mysqli_fetch_assoc($sql))
{
$file = $row['file_name'];
$img = "pile/".$file;
?>

	<tr align="center">
		<td align="center"><?=$no++;?></td>
		<!-- <td align="left"><a style="text-decoration: none;color: blue;" href="download.php?file=<?=$file;?>"><?=ucwords(substr($file, 11));?></a></td> -->
		<td align="left"><a style="text-decoration: none;color: steelblue;" href="check.php?id=<?=$row['id'];?>"><?=ucwords(substr($file, 11));?></a></td>
		<td><?=$row['time'];?></td>
		<td><a onclick="return confirm('Are you sure?');" style="text-decoration: none;color:red;" href="check_del.php?id=<?=$row['id'];?>">Remove</a></td>
	</tr>

<?php
}
?>
</table><br>
<?php
$query2 = mysqli_query($koneksi, "SELECT * FROM my_file");
$jmldata = mysqli_num_rows($query2);
$jmlhalaman = ceil($jmldata/$batas);
for($i=1; $i<=$jmlhalaman;$i++)
if($i != $halaman)
{
	echo "<a style='border-radius:10px;text-decoration:none;color:black;background:silver;padding:3px 8px' href='index.php?halaman=$i'>$i</a> ";
}
else
{
	echo "<span style='border-radius:10px;text-decoration:none;color:white;background:green;padding:3px 8px'>$i</span> ";
}
echo "<br><p>";
?>
<br><a style='text-decoration:none' href="upload-file.php">Upload New File</a><p>
<small>Total: <?=$jmldata;?> file</small>


<h2>Selamat datang di aplikasi file sharing</h2>
<small>
<p>1. Anda dapat mengupload file dari perangkat pribadi kemudian mendownloadnya, dan menghapusnya kapan saja</br>
2. File akan tampil di halaman index, tapi tidak dapat didownload/dihapus, kecuali dengan memasukan password yang benar<br>3. Ekstensi file yang didukung adalah jpg, png, jpeg, ico, pdf, doc, docx, xls, xlsx, zip dan rar</br>
4. Ukuran file yang bisa diupload dibatasi hingga 10 MB.
</small>

</center>

</body>
</html>