<?php
include 'connection.php';
$id = $_GET['update'];
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    $sql = "update employee set name='$name', email='$email', mobile='$mobile', password='$password' where id=$id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        header('location: view.php');
    }
}

$query = "select * from Employee where id=$id";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
if ($result) {
    $id =  $row['ID'];
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
        <form method="post" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" maxlength="10" class="form-control" name="name" placeholder="Enter your name" value="<?= $name; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter your email" value="<?= $email; ?>" required>
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="tel"  class="form-control" name="mobile" placeholder="Enter your mobile" value="<?= $mobile; ?>" required>
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