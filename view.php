
<?php
	session_start();
	$conn = new mysqli("localhost", "root", "123", "project");
	if(!isset($_SESSION['name']))
	{
		header("location : index.php");
	}
	else
	{
		if(isset($_SESSION['id']))
		{
			$id = $_SESSION['id'];
		}
	}
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
	}
	if(isset($_POST['add']))
	{
		$date = date('Y-m-d', time());
		
		$ssql = "Select * from attendence where date = '$date' and lid = '$id'";
		$sresult = $conn->query($ssql);
		if($sresult->num_rows > 0)
		{
			echo "<script>alert('Today`s attendence already inserted.');</script>";
		}
		else
		{
			$insql = "Insert into attendence(lid, date, status) values('$id', '$date', 'PRESENT')";
			if ($conn->query($insql) === TRUE) {
				echo "<script>alert('Attendence record Inserted');</script>";
			} else {
				echo "<script>alert('Error Occurred');</script>";
			}
		}
	}



	if(isset($_POST['qadd']))
	{
		$date = date('Y-m-d', time());
		$tmr = date("Y-m-d",strtotime("tomorrow"));
		$ssq2 = "Select * from attendence where date = '$tmr' and lid = '$id'";
		$sresult1 = $conn->query($ssq2);
		if($sresult1->num_rows > 0)
		{
			echo "<script>alert('Tommorows `s attendence already inserted.');</script>";
		}
		else
		{
			$insql2 = "Insert into attendence(lid, date, status) values('$id', '$tmr', 'PRESENT')";
			if ($conn->query($insql2) === TRUE) {
				echo "<script>alert('Attendence record Inserted');</script>";
			} else {
				echo "<script>alert('Error Occurred');</script>";
			}
		}
	}







?>
<html>
<head><title>MH MESCE</title></head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>

	body{
margin:auto;
		font-family: "Century Gothic", CenturyGothic, AppleGothic, sans-serif; 
	}
.header
{
	height: 80px; 
	background: white;
	color: purple; 
	font-size: 25px; 
	  
	
	font-family: Monotype Cursiva;
}
.name
{
	font-size: 30px;
	border: 2px aqua solid;
	border-radius: 10px;
	display: inline-block;
	padding: 2px 5px;
	background: aqua;
	cursor: pointer;
	display:flex;
	flex-direction:raw;
}

.logout
{
	
	font-size: 25px;
	
	display: block;
	padding: 2px 5px;
	
	cursor: pointer;
	float:right;
}

.button
{
	background: skyblue;
	padding: 5px 15px;
	font-size: 25px;
	box-shadow:1px 1px 1px 1px lightgrey;
	color:white;
	cursor: pointer;
	border-width: 0px;
	margin:5px;
	
	
}
#add
{
	margin-right:auto;
	margin-left:auto;
	margin-top:10px;
	background: #538893;
	font-size: 25px;
	
	padding: 50px ;
	width:70%;
	



}
#view
{
	margin-top:10px;
	display: none;
	margin-left :auto;
	margin-right:auto;
	width:70%;
	background: #538893;
	font-size: 30px;
	min-height:250px;
	padding: 20px 50px;
}
#fff{
display:none;
width:70%;
margin-left:auto;
	background: #538893;
	font-size: 30px;
	padding: 20px 50px;
	margin-top:10px;
	margin-right:auto;
	min-height:200px;

}

#comp{
	width:70%;
display:none;

	background: #538893;
	font-size: 30px;
	margin-top:10px;
	
	padding: 20px 50px;
	margin-left:auto;
	margin-right:auto;
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

.tablec{

	text-align:center;
	margin-left:auto;
	margin-right:auto;
	display:block;


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

</style>

<body bgcolor="white" style="margin:0px;">
<div class="header">

<div class="dt">
	
<div class="d1">  <i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php 
		$sname = $_SESSION['name']; 
		echo $sname;
	?>
	<br>
	
	<i class="fa fa-calendar" aria-hidden="true"></i> <?php 
	$date =date('Y-m-d');
	echo $date;
	?>
	<?php
	echo"&nbsp; ";
	   $jd = cal_to_jd(CAL_GREGORIAN,date("m"),date("d"),date("Y"));
	   echo(jddayofweek($jd,1));
	?> 
</div>
<div class="d3"><img src="mes.png" width="38px" height="38px"></div>
<div class="d2"><a style="text-decoration:none;color:blue;" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></div>
</div>
</div>

<div class="tablec">
	<table width="90%" border = "1">
		<?php
			$sql = "Select * from login where id = '$id'";
			$result = $conn->query($sql);
			if($result->num_rows== 1)
			{
				while($rows = $result->fetch_assoc())
				{
					$name = $rows['name'];
					$college = $rows['college'];
					$regd = $rows['registration'];
					$semester = $rows['semester'];
					$phone = $rows['phone'];
					echo "	<tr><th>Name</th>
							<td>".$name."</td></tr><tr>
							<th>Room number</th>
							<td>".$college."</td></tr><tr>
							<th>Registration No.</th>
							<td>".$regd."</td></tr><tr>
							<th>Semester</th>
							<td>".$semester."</td></tr><tr>
							<th>Phone Number</th>
							<td>".$phone."</td></tr>
					";
					
				}
			}
		?>
	</table>
</div>
<style>
.quickadd{
margin:20px;
}
.qtn{
padding:10px;
text-align:center;
border:none;
background-color:black;
color:white;
margin-left:auto;
margin-right:auto;
display:block;
cursor:pointer;
margin-top:5px;
width:50%;

}
</style>

<div class="quickadd"> 

</div>



<div style="margin-top: 50px; text-align:center; margin-left:auto; margin-right:auto; width:90%; ">
	<button class = "button" onclick="add();">Add Attendence</button>
	<button class = "button" style="margin-left: 2px;" onclick="view();">View Attendence</button>
	<button class = "button" onclick="food();" >Today's Menu</button>
	<button class = "button" onclick="com();" >Complaint</button>
</div>
<div id = "add">
	<br>
	REGISTER YOUR ATTENDENCE 
	<br><br>
	<center>
		<form method = "post">
			<button name = "add" class="qtn" >
			<i class="fa fa-check-circle-o" aria-hidden="true"></i>  mark for Today
			</button>

			<button name ="qadd"  class="qtn"> <i class="fa fa-check-circle-o" aria-hidden="true"></i>   Mark for Tommorow </button>

		</form>
	</center>
</div>


<div id = "view">
	<table width="95%" style = 'border-color: black;' border = "1">
		<tr>
			<td>Sl.No.</td>
			<td>Date</td>
			<td>Status</td>
		</tr>
		<?php
			$c = 0;
			$sql = "Select * from attendence where lid = '$id' ORDER BY date ASC";
			$result = $conn->query($sql);
			if($result->num_rows > 0)
			{
				while($rows = $result->fetch_assoc())
				{
					$dt = $rows['date'];
					$date = date("d-m-Y", strtotime($dt));
					$status = $rows['status'];
					$c++;
					echo "	<tr>
								<td>".$c."</td>
								<td>".$date."</td>
								<td>".$status."</td>
							</tr>
					";
					
				}
				echo "Total no. of days present = ".$c;
			}
		?>
	</table>

</div>


<div id="fff">




<table  style = 'width:90%; text-align:center;' border = "2">
		<tr><td style="background: #259885;"><b>Brakefast</b></td>
			<td style="background: #259885;"><b>Lunch</b></td>
			<td style="background: #259885;"><b>Tea</b></td>

			<td style="background: #259885;"><b>Dinner</b></td>
			
		</tr>



		<?php
			$sql = "Select * from foodmenu";
			$result = $conn->query($sql);
			

			if($result->num_rows >0)
			{
				while($rows = $result->fetch_assoc())
				{
					$mng = $rows['breakfast'];
					$lun = $rows['lunch'];
					$eve = $rows['tea'];
					$nit = $rows['dinner'];
					
				}
						
					echo "
							<tr>
							
							<td>".$mng."</td>
							<td>".$lun."</td>
							<td>".$eve."</td>
							<td>".$nit."</td>
							</tr>
					";
					
				
			}
		?>
	</table>


</div>

<style>
.comln{
	width:100%;
}



</style>
<div id="comp">
<form method ="post">
	<h4>REGISTER YOUR COMPLAINT</h4>
			<textarea  rows="15" name="com" class="comln"></textarea>
			<br><br>
    <input type = "submit"  value="Register Complaint" name = "login1" class = "button" style="background-color:green; color:white; border:1px solid green; ">


            </form>


</div>

</body>
<script>
	function name1()
	{
		if(document.getElementById('logout').style.display == 'none')
		{
			document.getElementById('logout').style.display = 'inline-block';
		}
		else
		{
			document.getElementById('logout').style.display = 'none';
		}
	}
	function add()
	{
		document.getElementById('view').style.display = 'none';
		document.getElementById('add').style.display = 'block';
		
		document.getElementById('fff').style.display = 'none';
		document.getElementById('comp').style.display = 'none';
	}
	function view()
	{
		document.getElementById('add').style.display = 'none';
		document.getElementById('view').style.display = 'block';
		
		document.getElementById('fff').style.display = 'none';
		document.getElementById('comp').style.display = 'none';
	}

function food()
{
	document.getElementById('add').style.display = 'none';
		document.getElementById('view').style.display = 'none';
		document.getElementById('fff').style.display = 'block';
		document.getElementById('comp').style.display = 'none';



}
function com(){
	document.getElementById('add').style.display = 'none';
		document.getElementById('view').style.display = 'none';
		document.getElementById('fff').style.display = 'none';
		document.getElementById('comp').style.display = 'block';



	
}

</script>

<?php
if(isset($_GET['id']))
	{
		$id = $_GET['id'];
	}
            if(isset($_POST['login1']))
	{
		$ctext = $_POST['com'];
		         $date = date('Y-m-d', time());
				$sql = "Insert into complaint(id, date, complaint) values('$id', '$date', '$ctext')";
				if ($conn->query($sql) === TRUE) {
					echo "<script>alert('complaint registered');</script>";
				} else {
					echo "<script>alert('Error Occurred');</script>";
				}
			}
			
	
    ?>


<div style="background-color:black; color:white; padding:10px;text-align:center;">Developed by ingle corp</div>


</html>