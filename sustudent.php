<!DOCTYPE html>
<html>
	<head>
		<style> table {
			width: 100%;
			border-collapse: collapse; border: 1px solid black;
		}
		
		#modules tr:nth-child(even){ background-color: #f2f2f2;
		}
		
		.footer {
			position: fixed; left: 0;
			bottom: 0;
			width: 100%;
			}
			
			</style>
			</head>
			<head>
				<img src="SUmenubar.png" style="display: block; width: 100%">
				<h1 style="margin: 0px; color:white; background-color:#0068c6; font-family:Helvetica; font-weight:100;"> Student Record Card</h1>
			</head>
			<br>
			<form action="sustudent.php" method="POST" style="font-family:calibri; font-style:bold" >
			<b>Query by Student ID #: <input type="text" name="sid" id="sid" ></b>
			<button type="submit" value="submit" name="submit" style="float: right;">Submit</button>
		</form>
		<hr>
		
		<body>
			<b style="font-family:calibri; font-style:bold">Personal Details</b><br>
			
			<?php require_once("dbconnect.php");
			$stud_id = isset ($_POST['sid']) ? $_POST['sid'] : "";
			$query = mysqli_query($conn,"select sid, title, concat(firstname, ' ', lastname) as fullname, dob, gender from stud where (sid = '$stud_id')"); // fetch data from database
			if(isset($_POST['submit'])){
				if ($row = mysqli_fetch_array($query))
				{
					echo "<table border='1'>";
					echo '<tr style="font-family: calibri">'; echo "<td>";
					echo "<span style='text-align:left'>Student ID" . "<span style='float:right'>". $row['sid']. "</span></br>"; echo "<span style='text-align:left'>Title" . "<span style='float:right'>". $row['title'] . "</span></br>"; echo "<span style='text-align:left'>Full name" . "<span style='float:right'>". $row['fullname']
					. "</span></br>";
					echo "<span style='text-align:left'>Date of Birth:" . "<span style='float:right'>". $row['dob']
					. "</span></br>";
					echo "<span style='text-align:left'>Gender" . "<span style='float:right'>". $row['gender'] . "</span></br>"; echo "</td>";
					echo "</tr>"; echo "</table>";
				}
			}
			?>
			
			<b style="font-family:calibri; font-style:bold">Course Details</b>
			<?php require_once("dbconnect.php");
			$query1 = mysqli_query($conn,"select distinct prog.pid, prog.ptitle, concat(prog.paward, ' ', prog.ptitle, ' ', prog.length, 'yr') as pscheme from prog, enrl where prog.pid = enrl.pid AND (sid = '$stud_id')");
			if(isset($_POST['submit'])){
				if ($row = mysqli_fetch_array($query1))
				{
					echo "<table border='1'>";
					echo '<tr style="font-family: calibri">'; echo "<td>";
					echo "<span style='text-align:left'>UCAS Code" . "<span style='float:right'>" . $row['pid'] . "</span>"."</span></br>";
					echo "<span style='text-align:left'>Degree Scheme" . "<span style='float:right'>" . $row['pscheme'] . "</span>"."</span></br>";
					echo "<span style='text-align:left'>Department" . "<span style='float:right'>". $row['ptitle'] . "</span></br>"; echo "</td>";
					echo "</tr>"; echo "</table>";
				}
			}
			?>
			
			<hr>
			<b style="font-family:calibri; font-style:bold">Enrolment and Progress</b>
			<table>
				<tr>
					<th><b style="font-family:calibri ">Academic Year</b></th>
					<th><b style="font-family:calibri">Enrolment Status</b></th>
					<th><b style="font-family:calibri">Programme</b></th>
					<th><b style="font-family:calibri">Course Year</b></th>
				</tr>
				
				<?php require_once("dbconnect.php");
				$query2 = mysqli_query($conn,"select enrl.ayr, enrl.status, prog.ptitle, enrl.lvl from prog, enrl where prog.pid= enrl.pid AND (sid = '$stud_id') order by ayr desc;"); 
				if(isset($_POST['submit'])){
					while ($row = mysqli_fetch_array($query2)){
						echo '<tr style="font-family: calibri">';
						echo "<td align=center>" . $row['ayr'] . "</td>"; echo "<td align=center>" . $row['status'] . "</td>"; echo "<td align=center>" . $row['ptitle'] . "</td>"; echo "<td align=center>" . $row['lvl'] . "</td>"; echo "</tr>";
					}
					echo "</table>";
				}
				?>
				
				<hr>
				<b style="font-family:calibri; font-style:bold">Module Selection</b>
				<?php require_once("dbconnect.php");
				$query3 = mysqli_query($conn,"select smod.ayr, mods.mid, mods.mtitle, mods.credits from mods, smod where smod.mid = mods.mid AND (sid = '$stud_id') order by smod.ayr desc, mods.mid desc;");
				
				if(isset($_POST['submit'])){ echo "<table id='modules'>";
					echo '<tr style="font-family: calibri">';
					while ($row = mysqli_fetch_array($query3)){ 
						echo "</td>";
						echo '<tr style="font-family: calibri">'; 
						echo "<td>";
						echo '<th align="center">' . $row['ayr'] . '</th>'; 
						echo "</td>";
						echo '<tr style="font-family: calibri">'; 
						echo "<div>";
						echo "<td align=center>" . $row['mid'] . "</td></div>"; 
						echo "<td align=center>" . $row['mtitle'] . "</td>"; 
						echo "<td align=center>" . $row['credits'] . "</td>"; 
						echo "</tr>";
						echo "</tr>";
					}
					echo "</table>";
				}
				?>
				
			</table>
			<img style="width: 100%; bottom:0; left:0;" src="SUlogo.png"/>
		</body>
		</html>
