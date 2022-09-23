<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $deparment = $_POST['department'];
    $location = $_POST['location'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];                                  
#insert into department(DeptName, DeptLocation) values('$department', '$location')

#INSERT INTO <target table> (<columns>) SELECT <columns> FROM <table 1> UNION SELECT <columns> FROM <table 2>;

    $query = "insert into Employee(Name, Email, Mobile, Password) values('$name', '$email', '$mobile', '$password')";
    $result = mysqli_query($con, $query);
    if ($result) {
        header('location: view.php');
    }
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

    <div class="container">
        <a href="view.php" class="text-light"><button class="btn btn-primary my-5">Home</button></a>
        <form method="post" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
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
                <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="tel" class="form-control" name="mobile" placeholder="Enter your mobile" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>

</body>

</html>