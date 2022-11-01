<?php
include 'connection.php';
$empid = $_GET['emp_id'];
//$designation_id= $_GET['designation_id'];
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $department = implode($_POST['department']);
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    $query = "UPDATE employee, designation SET employee.name='$name', designation.dept_id=$department, employee.email='$email', employee.mobile='$mobile', employee.password='$password' WHERE employee.emp_id=$empid";
    $result = mysqli_query($con, $query);
    if ($result) {
        header('location: view.php');
    }
}

//display data in table to update code                               

$query = " SELECT * FROM Employee JOIN designation ON designation.emp_id = employee.emp_id JOIN department ON department.dept_id = designation.dept_id WHERE employee.emp_id=$empid";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
if ($result) {
    $id =  $row['emp_id'];
    $name = $row['name'];
    $email = $row['email'];
    $mobile =  $row['mobile'];
    $password =  $row['password'];
    $userdept_id = $row['dept_id'];
  
}
//Department checkbox display
// $new_query = "SELECT * FROM designation WHERE designation.designation_id = $designation_id";
// $result_user_dept = mysqli_query($con, $new_query);
// $row = mysqli_fetch_assoc($result_user_dept);

//$userdept_id1 = explode(",", $userdept_id);
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
    <div class="container my-2">
        <a href="view.php" class="text-light"><button class="btn btn-primary my-3">Home</button></a>

        <form method="post" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" maxlength="10" class="form-control" name="name" placeholder="Enter your name" value="<?= $name; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Select Department</label><br>
                <?php $dept_query_new =  "SELECT * FROM department";
                $results = mysqli_query($con, $dept_query_new);
                foreach ($results as $result) :
                    $dept_id  = $result['dept_id'];
                    //$dept_id1  = explode(",", $dept_id);
                    $dept_name  =  $result['dept_name'];
                    
                ?>
                    <?php

                    
                        if($dept_id === $userdept_id){
                            $checked = "checked";
                        } else {
                            $checked = "";
                        }
                    ?>
                    <input type="checkbox" id="<?= strtolower($dept_name) ?>" name="department[]" value="<?= $dept_id ?>" <?= $checked ?> >
                    <label for="<?= strtolower($dept_name) ?>"> <?= $dept_name ?></label><br>
                <?php endforeach; ?>
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