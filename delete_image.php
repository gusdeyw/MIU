<?php
session_start();
$id = $_GET['id'];
$img = $_GET['img'];
include "db_connect.php";
$sql = "SELECT images FROM property_list WHERE id_property= '$id'";
$result = mysqli_query($con, $sql);

unlink("$img");

$image = "";
while ($row = mysqli_fetch_assoc($result)) {
    $image = $row['images'];
}
$arr = explode(", ", $image);

$hasil = array_search($img, $arr);
print_r($hasil);
if ($hasil !== false) {
    // Remove from array
    unset($arr[$hasil]);
}

$hasilakhir = implode(", ", $arr);
mysqli_query($con,"UPDATE property_list SET images = '$hasilakhir' WHERE id_property= '$id'");
header("Location:drag_drop.php?id=$id");