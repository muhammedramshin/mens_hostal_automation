<?php



if(isset($_POST['login'])){
	$mng = $_POST['m1'];
	$lng = $_POST['m2'];
	$tng = $_POST['m3'];
	$nng = $_POST['m4'];

$sql1 = "UPDATE foodmenu SET breakfast='$mng' WHERE id='0'";

$sql2 = "UPDATE foodmenu SET lunch='$lng' WHERE id='0'";
$sql3 = "UPDATE foodmenu SET tea='$tng' WHERE id='0'";
$sql4 = "UPDATE foodmenu SET dinner='$nng' WHERE id='0'";




$result1 = $conn->query($sql1);

$result2 = $conn->query($sql2);
$result3 = $conn->query($sql3);
$result4 = $conn->query($sql4);
echo "<script>alert('Food menu updated');</script>";

}

?>