<?php

$nisn = $_GET['nisn'];

include '../koneksi.php';
$sql = "DELETE from siswa where nisn='$nisn'";
$query = mysqli_query($koneksi, $sql);
if ($query) {
    header("location:?url=siswa");
} else {
    echo "<script>alert('maaf data tidak terhapus'); window.location.assign('?url=siswa');</script>";
}