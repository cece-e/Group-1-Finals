<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "pet_inventory";

$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn){
    die("Connection failed.");
}

$sql = "SELECT * FROM pets";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Inventory</title>
</head>
<body>
<div class="container">
    <h1>₊˚⊹ 𐂯 Pet Inventory 𐂯 ⊹ ˚ ₊</h1>
    <a href = "addPet.php" class="addpet-btn">
        + Add New Pet
    </a>
</div>

<table class="petsTable">
    <tr class="table-dark">
            <th>Pet ID</th>
            <th>Photo</th>
            <th>Pet Name</th>
            <th>Pet Species</th>
            <th>Pet Breed</th>
            <th>Pet Age</th>
            <th>Pet Status</th>
            <th>Actions</th>
    </tr>
    <?php
    while($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>".$row['pet_id']."</td>";
    echo "<td>";
    echo "<img src='../uploads/".$row['image']."' width='80'>";
    echo "</td>";

    echo "<td>".$row['pet_name']."</td>";
    echo "<td>".$row['species']."</td>";
    echo "<td>".$row['breed']."</td>";
    echo "<td>".$row['age']."</td>";
    echo "<td>";

    if($row['status'] == "Available"){
        echo "<span class='badge bg-success'>✅ Available</span>";
    }else if($row['status'] == "Pending"){
        echo "<span class='badge bg-warning'>⏳ Pending</span>";
    }else{
        echo "<span class='badge bg-danger'>🎉 Adopted</span>";
    }
    echo "</td>";
    echo "<td>";
    echo "<a href='edit_pet.php?id=".$row['pet_id']."' class='editBtn'>
            ✏️ Edit
        </a> ";
    echo "<a href='delete_pet.php?id=".$row['pet_id']."' class='deleteBtn'>
            ❌ Delete
        </a>";
    echo "</td>";
    echo "</tr>";
}
    ?>
</table>
</body>
</html>