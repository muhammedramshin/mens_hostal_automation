<?php
	session_start();
	$conn = new mysqli("localhost", "root", "123", "project");
	if(!isset($_SESSION['name']))
	{
		header("location : index.php");
	}

?>
<html>
<head><title>MH MESCE</title></head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
	body{
		margin:auto;
		background-color:#f9f9f9;
	}
.header
{
	height: 50px; 
	background: white; 
	color: black; 
	font-size: 20px;   
	
	font-family: Monotype Cursiva;
	margin:auto;
}

.name
{
	
	font-size: 30px;
	border: 2px aqua solid;
	border-radius: 10px;
	display: inline-block;
	padding: 2px 5px;
	background: white;
	cursor: pointer;
}
.logout
{
	
	font-size: 25px;
	border: 2px violet solid;
	border-radius: 10px;
	display: none;
	padding: 2px 5px;
	background: violet;
	cursor: pointer;
}
td
{
	font-size: 25px;
	width: 400px;
}

.dt{
padding:10px;
display:flex;
flex-direction:raw;
color:black;
box-shadow:1px 1px 1px 1px lightgrey;
}
.d1{
width:45%;
font-size:12px;
}
.d2{
width:20%;
font-size:12px;
text-align:right;
}
.d3{
	font-size:12px;
	width:35%;
}



.today{
border:2px solid black;
padding:8px;
text-align:center;
margin:5px;
font-size:20px;
}
.date{
text-align:left;
font-size:18px;
width:20%;
}
table{
	border:none;
	
	text-align:center;
	margin-left:auto;
	margin-right:auto;

}
th{
	
	background-color:lightgreen;
	text-align:left;
}
td{
border:1px solid grey;
font-size: 15px;
	
	background-color:lightgreen;

}




.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: green;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.navbar {
  overflow: hidden;
  background-color: #333;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.foodupdate{
background-color:white;
padding:15px;
border-radius:5px;
	margin:4px;
	margin-top:8px;
	box-shadow:1px 1px 1px 1px lightgrey;
}

.contain{
	background-color:white;
padding:2px;
border-radius:5px;
margin:4px;
box-shadow:1px 1px 1px 1px lightgrey;
}


</style>

<body>
<div class="header">

<div class="dt">
	
<div class="d1">  <i class="fa fa-user-secret" aria-hidden="true"></i>
</i> <?php 
		$sname = $_SESSION['name']; 
		echo $sname;
	?>
	<br>
	
<i class="fa fa-calendar" aria-hidden="true"></i> <?php 
$date =date('Y-m-d');
echo $date;
?>
<?php
echo"&nbsp; &nbsp; &nbsp;";
   $jd = cal_to_jd(CAL_GREGORIAN,date("m"),date("d"),date("Y"));
   echo(jddayofweek($jd,1));
?> 
</div>
<div class="d3"><img src="mes.png" width="38px" height="38px"></div>
<div class="d2"><a style="text-decoration:none;" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></div>
</div>
</div>



<div class="navbar">
  <a href="#FM">FOOD MENU</a>
  <a href="#CM">COMPLIANTS</a>
  
  
</div>






<br>

<div class="contain">

<div class="today">
<?php
$date =date('Y-m-d');

$asql = "Select * from attendence where date = '$date'";
					$aresult = $conn->query($asql);
					$c = $aresult->num_rows;

echo "Total number of students present  today  is  <br>  <br> <span style='color:white; font-size:35;background-color:black;font-weight:900;padding:10px;'> &nbsp;  ".$c." &nbsp;  <span>" ;


?>
</div>

<table  style = ' border-color: violet; text-align:center;' border = "10">
		<tr><td style="background: #259885;"><b>Name</b></td>
			<td style="background: #259885;"><b>Room number</b></td>
			<td style="background: #259885;"><b>semester</b></td>
		</tr>
		<?php
		$date1 =date('Y-m-d');
			$sql3 = "Select * from login where id IN ( Select lid from attendence where date = '$date1')";
			$result3 = $conn->query($sql3);
			if($result3->num_rows >0)
			{
				while($rows = $result3->fetch_assoc())
				{
					$id = $rows['id'];
					$name = $rows['name'];
					$college = $rows['college'];
					$regd = $rows['registration'];
					$semester = $rows['semester'];
					$phone = $rows['phone'];
					
		
					echo "	
							<tr>
							<td><a href = 'view.php?id=".$id."'>".$name."</a></td>
							<td>".$college."</td>
							<td>".$regd."</td>
							
							</tr>
					";
					
				}
			}
		?>
	</table>

		</div>


<div id="FM" class="foodupdate">

<h4  style="text-align:center; font-weight:900;"  >Update Food menu</h4>
	<form  method ="post">

<table>

<?php



if(isset($_POST['f1'])){
	$mng = $_POST['m1'];
	
	

$sql1 = "UPDATE foodmenu SET breakfast='$mng' WHERE id='0'";

$result1 = $conn->query($sql1);
echo "<script>alert('Brakefast menu updated');</script>";
}
if(isset($_POST['f2'])){
	$lng = $_POST['m2'];
$sql2 = "UPDATE foodmenu SET lunch='$lng' WHERE id='0'";

$result2 = $conn->query($sql2);
echo "<script>alert('lunch menu updated');</script>";
}

if(isset($_POST['f3'])){
	$tng = $_POST['m3'];
$sql3 = "UPDATE foodmenu SET tea='$tng' WHERE id='0'";

$result3 = $conn->query($sql3);
echo "<script>alert('Tea menu updated');</script>";
}

if(isset($_POST['f4'])){
	$nng = $_POST['m4'];

$sql4 = "UPDATE foodmenu SET dinner='$nng' WHERE id='0'";
$result4 = $conn->query($sql4);
echo "<script>alert('Dinner menu updated');</script>";

}




?>

				<tr>
					<td>Breake fast</td>
					<td><input type = "text" name = "m1" class="textbox"></td>
					<td>
				<center><input type = "submit" value="Update" name = "f1" class = "button" style="font-size:12px; margin:4px; border-radius:5px; color:white;padding:9px; background-color:blue; border:none; "></center>
</td>
				</tr>
				<tr>
					<td>Lunch</td>
					<td><input type = "text" name = "m2" class="textbox"></td>

					<td>
				<center><input type = "submit" value="Update" name = "f2" class = "button" style="font-size:13px; margin:4px; border-radius:5px; color:white;padding:9px; background-color:blue; border:none; "></center>
</td>
				</tr>

				<tr>
					<td>Tea</td>
					<td><input type = "text" name = "m3" class="textbox"></td>

					<td>
				<center><input type = "submit" value="Update" name = "f3" class = "button" style="font-size:13px; border-radius:5px; margin:4px; color:white;padding:9px; background-color:blue; border:none; "></center>
</td>
				</tr>
				<tr>
					<td>Dinner</td>
					<td><input type = "txt" name = "m4" class="textbox"></td>
					<td>
				<center><input type = "submit" value="Update" name = "f4" class = "button" style="font-size:13px;  border-radius:5px; margin:4px; color:white;padding:9px; background-color:blue; border:none; "></center>
</td>
				</tr>


			
				


	




			</table>


		</form>
</div>

<!-- food menu ends-->













<br>


<div class="contain">

<table id="CM" style = ' border-color: black; text-align:center;' border = "2">
		<tr><td style="background: #259885;"><b>Name</b></td>
			<td style="background: #259885;"><b>Date</b></td>
			<td style="background: #259885;"><b>complaint</b></td>
			
		</tr>



		<?php
			$sql = "Select * from complaint";
			$result = $conn->query($sql);
			

			if($result->num_rows >0)
			{
				while($rows = $result->fetch_assoc())
				{
					$id = $rows['id'];
					$da = $rows['date'];
					$comp = $rows['complaint'];
					
					$sqla = "Select name from login where id='$id'";
$resulta = $conn->query($sqla);
					
					if($resulta->num_rows >0)
					{
						while($arow = $resulta->fetch_assoc())
						{
							$nam = $arow['name'];

						}
					}
						
					echo "
							<tr>
							<td><a href = 'view.php?id=".$id."'>".$nam."</a></td>
							<td>".$da."</td>
							<td>".$comp."</td>
							</tr>
					";
					
				}
			}
		?>
	</table>


		</div>
<br><br><br><br>









			<br><br><br><br>






















</div>
</body>
<div style="background-color:black; color:white; padding:10px;text-align:center;">Developed by ingle corp</div>

</html>