<!DOCTYPE html>
<html lang="en">
<head>
  <title>CP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
<div class ="row">
  <h2 style ="text-align:center; margin: 0 auto; color:#4A92BD;">Deem Sameer</h2>
  </div>
  <hr>
  <div class="row">
  <div class="col" style ="text-align:center; margin: 0 auto; color:#4A92BD;">
 <!-- <form class="form-inline" action=""> -->
        <button type="Left" class="btn btn-default" onclick="Left()">Left</button>
   
    <button type="Right" class="btn btn-default" onclick="Right()">Right</button>
    <br>
      <label for="Forward">Forward:</label>
      <input type="Forward" class="form-control" id="Forwardinput" placeholder="Enter in m" name="Forward">
    
    <button type="submit" class="btn btn-default" onclick="Forward()">enter</button>
	<div class="row">
		<button type="submit" class="btn btn-default" onclick="DeleteFun()">Delete</button>
		<form action="" method="post">
	    <button type="submit" class="btn btn-default" name="Save">Save</button>
		  <input type="hidden" id="sql" name="sql" value="">
        </form>
	</div> 
</div>
<div class="col">
<table style="border:solid text-align:center; margin: 0 auto; color:#4A92BD;" id="myTable";>
  <tr>
    <th >#</th>
    <th >movments</th> 
  </tr>
</table>
</div>
</div>
<hr>
<div class="row">
<canvas id="myCanvas" width="1200" height="400" style="border:1px solid #d3d3d3;">
Your browser does not support the HTML canvas tag.</canvas>
</div>
</div>

<script>
var c = document.getElementById("myCanvas");
var ctx = c.getContext("2d");
ctx.lineWidth = "5";
ctx.strokeStyle = "gray"; // Gray path
var right=false; 
var left=false; 
var basex=1;
var basey=1;
var x;
var Count=0;
function Forward(){
ctx.moveTo(basex,basey);
if(right){
console.log("starty"+basey+"startx"+basex)
var x=document.getElementById('Forwardinput').value;
x=parseInt(x);
basex+=x;
ctx.lineTo(basex,basey);
ctx.stroke();
right=false; 
}
else if (left){
console.log("starty"+basey+"startx"+basex)
var x=document.getElementById('Forwardinput').value;
x=parseInt(x);
basex-=x;
ctx.lineTo(basex,basey);
ctx.stroke();
left=false; 
}
else {
var y=document.getElementById('Forwardinput').value;
y=parseInt(y);
basey+=y;
ctx.lineTo(basex,basey);
ctx.stroke();
}
  var table = document.getElementById("myTable");
  var row = table.insertRow(0);
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  cell1.innerHTML = Count++;
  cell2.innerHTML = "Forward:"+document.getElementById('Forwardinput').value;
  document.getElementById("sql").value+=" INSERT INTO instruction2 (Forward) VALUES ("+document.getElementById('Forwardinput').value+"); ";
}
function Right(){
right=true;
  var table = document.getElementById("myTable");
  var row = table.insertRow(0);
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  cell1.innerHTML = Count++;
  cell2.innerHTML = "Right";
  document.getElementById("sql").value+=" INSERT INTO instruction2 (RightTurn) VALUES ("+1+"); ";

}
function Left(){
left=true;
  var table = document.getElementById("myTable");
  var row = table.insertRow(0);
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  cell1.innerHTML = Count++;
  cell2.innerHTML = "Left";
  document.getElementById("sql").value+=" INSERT INTO instruction2 (LeftTurn) VALUES ("+1+"); ";
  }
  
function DeleteFun(){
  $("#myTable").remove(); 
     ctx.clearRect(0, 0, c.width, c.height);
}
</script>
<?php 
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "ControlPanel";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

if(isset($_POST['Save'])){
	$sql =$_POST['sql'] ;
}

// Execute multi query
if ($mysqli -> multi_query($sql)) {
  do {
    // Store first result set
    if ($result = $mysqli -> store_result()) {
      while ($row = $result -> fetch_row()) {
      }
     $result -> free_result();
    }
    // if there are more result-sets, the print a divider
    if ($mysqli -> more_results()) {
    }
     //Prepare next result set
  } while ($mysqli -> next_result());
}
else 
	$mysqli->query($sql);//one query

$mysqli -> close();
?>

</body>
</html>
