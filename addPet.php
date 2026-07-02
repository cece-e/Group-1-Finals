<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "pet_inventory";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['addPet'])){
    $petName = $_POST['pet_name'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $status = $_POST['status'];

    $image = $_FILES['image']['name'];
    $tempName = $_FILES['image']['tmp_name'];

    move_uploaded_file($tempName, "../uploads/".$image);

    $sql = "INSERT INTO pets (pet_name, species, breed, age, status, image)
            VALUES ('$petName', '$species', '$breed', '$age', '$status', '$image')";

    if(mysqli_query($conn, $sql)){
        echo "<script>
                alert('Pet added successfully!');
                window.location='pet_inventory.php';
              </script>";
    }else{
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Pet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>🐾 Add New Pet 🐾</h2>

<form action="" method="POST" enctype="multipart/form-data">

    <label>Pet Name</label><br>
    <input type="text" name="pet_name" required placeholder="Brownie, Chestnut, etc.."><br><br>

    <label>Species</label><br>
    <input type="text" name="species" required placeholder="Cat, Dog, etc.."><br><br>

    <label>Breed</label><br>
    <input type="text" name="breed" required placeholder="Persian, Labrador, etc.."><br><br>

    <label>Age</label><br>
    <input type="number" name="age" required placeholder="How old they are.."><br><br>

    <label>Status</label><br>
    <select name="status">
        <option value="Available">Available</option>
        <option value="Pending">Pending</option>
        <option value="Adopted">Adopted</option>
    </select>

    <br><br>

    <label>Pet Image</label><br>
    <input type="file" name="image" required>
    <br><br>

    <button type="submit" name="addPet">🐾 Add Pet</button>

</form>
</body>
</html>