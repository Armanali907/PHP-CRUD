<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    $query = "INSERT INTO Employee(Name, Email, Mobile, Password) VALUES('$name', '$email', '$mobile', '$password')";
    $result = mysqli_query($con, $query);

    foreach ($department as $deptid) {
        if ($result) {
            $id_query = "SELECT empid from Employee ORDER BY empid DESC";
            $result1_new = mysqli_query($con, $id_query);
            if ($result1_new) {
                $row1 = mysqli_fetch_assoc($result1_new);
                $empid = $row1['empid'];
                $query1 = "INSERT INTO Empartment(EmpId, DeptId) VALUES($empid, $deptid)";
                $result1 = mysqli_query($con, $query1);
                if ($result1) {
                    header('location: view.php');
                }
            }
        }
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
                <label class="form-label">Select Department</label><br>
                <?php $dept_query_new =  "SELECT * FROM department";
                $results = mysqli_query($con, $dept_query_new);
                foreach($results as $result): 
                $DeptId  = $result['DeptId'];
                $DeptName  =  $result['DeptName'];
                $DeptLocation =   $result['DeptLocation'] ;
                ?>
                <input type="checkbox" id="<?= strtolower($DeptName) ?>" name="department[]" value="<?= $DeptId ?>" >
                <label for="<?= strtolower($DeptName) ?>"> <?= $DeptName ?></label><br>
                <?php endforeach; ?>
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