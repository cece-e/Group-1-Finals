<?php
$conn = mysqli_connect("localhost","root","","pet_adoption");

if(!$conn){
    die("Connection Failed");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Reports</title>

    <style>
        body{
            font-family:Arial;
            margin:30px;
        }

        table{
            border-collapse:collapse;
            width:100%;
        }

        table,th,td{
            border:1px solid black;
            padding:10px;
        }

        h2{
            color:darkgreen;
        }

        select,input{
            padding:8px;
        }

        button{
            padding:8px 20px;
        }
    </style>

</head>

<body>

<h2>Reports</h2>

<form method="POST">

Report Type

<select name="report">

<option value="">Select Report</option>

<option value="pets">Pet Inventory</option>

<option value="adoption">Adoption Requests</option>

<option value="users">Manage Users</option>

</select>

<button name="generate">Generate Report</button>

</form>

<br>

<?php

if(isset($_POST['generate'])){

$report=$_POST['report'];

if($report=="pets"){

$sql="SELECT * FROM pets";

$result=mysqli_query($conn,$sql);

echo "<h3>Pet Inventory Report</h3>";

echo "<table>";

echo "<tr>
<th>ID</th>
<th>Name</th>
<th>Type</th>
<th>Breed</th>
<th>Status</th>
<th>Date Added</th>
</tr>";

while($row=mysqli_fetch_assoc($result)){

echo "<tr>";

echo "<td>".$row['id']."</td>";

echo "<td>".$row['pet_name']."</td>";

echo "<td>".$row['pet_type']."</td>";

echo "<td>".$row['breed']."</td>";

echo "<td>".$row['status']."</td>";

echo "<td>".$row['date_added']."</td>";

echo "</tr>";

}

echo "</table>";

}

elseif($report=="adoption"){

$sql="SELECT * FROM adoption_requests";

$result=mysqli_query($conn,$sql);

echo "<h3>Adoption Request Report</h3>";

echo "<table>";

echo "<tr>
<th>ID</th>
<th>Adopter</th>
<th>Pet</th>
<th>Status</th>
<th>Request Date</th>
</tr>";

while($row=mysqli_fetch_assoc($result)){

echo "<tr>";

echo "<td>".$row['id']."</td>";

echo "<td>".$row['adopter_name']."</td>";

echo "<td>".$row['pet_name']."</td>";

echo "<td>".$row['status']."</td>";

echo "<td>".$row['request_date']."</td>";

echo "</tr>";

}

echo "</table>";

}

elseif($report=="users"){

$sql="SELECT * FROM users";

$result=mysqli_query($conn,$sql);

echo "<h3>User Report</h3>";

echo "<table>";

echo "<tr>
<th>ID</th>
<th>Full Name</th>
<th>Role</th>
</tr>";

while($row=mysqli_fetch_assoc($result)){

echo "<tr>";

echo "<td>".$row['id']."</td>";

echo "<td>".$row['fullname']."</td>";

echo "<td>".$row['role']."</td>";

echo "</tr>";

}

echo "</table>";

}

else{

echo "Please select a report.";

}

}

?>

</body>
</html>
