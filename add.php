<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    // Inserting into employee table

    $query = "INSERT INTO Employee(Name, Email, Mobile, Password) VALUES('$name', '$email', '$mobile', '$password')";
    $result = mysqli_query($con, $query);

    // Inserting into designation table
    
        if ($result) {
            $id_query = "SELECT emp_id from Employee ORDER BY emp_id DESC";
            $id_query_result = mysqli_query($con, $id_query);
            if ($id_query_result) {
                $row = mysqli_fetch_assoc($id_query_result);
                $emp_id = $row['emp_id'];
                foreach ($department as $dept_id) {
                $query1 = "INSERT INTO designation(emp_id, dept_id) VALUES($emp_id, $dept_id)";
                $result1 = mysqli_query($con, $query1);
                }
                if ($result1) {
                    header('location: view.php');
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
            <!-- checkbox code -->
            <div class="mb-3">
                <label class="form-label">Select Department</label><br>
                <?php $dept_query_new =  "SELECT * FROM department";
                $results = mysqli_query($con, $dept_query_new);
                
                //getting departments dynamically

                foreach($results as $result): 
                $dept_id  = $result['dept_id'];
                $dept_name  =  $result['dept_name'];
                ?>
                <input type="checkbox" id="<?= strtolower($dept_name) ?>" name="department[]" value="<?= $dept_id ?>" >
                <label for="<?= strtolower($dept_name) ?>"> <?= $dept_name ?></label><br>
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