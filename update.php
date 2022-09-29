<?php
include 'connection.php';
$id = $_GET['update'];
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $department = $_POST['department'];
    $location = $_POST['location'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    $sql = "update e set name='$name', department='$department', location='$location', email='$email', mobile='$mobile', password='$password' from Employee e inner join Department d on e.EmpId=d.EmpId where empid=$id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        header('location: view.php');
    }
}


// UPDATE im
// SET mf_item_number = gm.SKU --etc
// FROM item_master im
// JOIN group_master gm
//     ON im.sku = gm.sku 
// JOIN Manufacturer_Master mm
//     ON gm.ManufacturerID = mm.ManufacturerID
// WHERE im.mf_item_number like 'STA%' AND
//       gm.manufacturerID = 34

$query = "select * from Employee where EmpId=$id";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
if ($result) {
    $id =  $row['EmpId'];
    $name = $row['Name'];
    $email = $row['Email'];
    $mobile =  $row['Mobile'];
    $password =  $row['Password'];
    
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <a href="view.php" class="text-light"><button class="btn btn-primary my-5">Home</button></a>

        <form method="post" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" maxlength="10" class="form-control" name="name" placeholder="Enter your name" value="<?= $name; ?>" required>
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Select Deparment</label><br>
                <select name="department" id="department">
                    <option value="">--Please choose an option--</option>
                    <option value="developer">Developer</option>
                    <option value="tester">Tester</option>
                    <option value="designer">Designer</option>
                    <option value="team lead">Team Lead</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Deparment Location</label><br>
                <select name="location" id="location">
                    <option value="">--Please choose an option--</option>
                    <option value="delhi">Delhi</option>
                    <option value="mumbai">Mumbai</option>
                    <option value="banglore">Banglore</option>
                    <option value="chennai">Chennai</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter your email" value="<?= $email; ?>" required>
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="tel" class="form-control" name="mobile" placeholder="Enter your mobile" value="<?= $mobile; ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control" name="password" placeholder="Enter your password" value="<?= $password; ?>" required>
            </div>
            <button type="submit" class="btn btn-success" name="submit">Update</button>
        </form>
    </div>

</body>

</html>