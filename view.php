<?php
include 'connection.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <a href="view.php" class="text-light"><button class="btn btn-primary my-5">Home</button></a>
        <a href="add.php" class="text-light"><button class="btn btn-primary my-5">Add User</button></a>
        <!-- Search Button -->
        <form method="get">
            <input type="text" name="search">
            <a href="view.php" class="text-light"><button type="submit" class="btn btn-primary">Search</button></a>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">EmpId</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">DeptId</th>
                    <th scope="col">Department</th>
                    <th scope="col"> Department Location</th>
                    <th scope="col">Operation</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // pagination logic code
                $result_per_page = 5;

                $sql = "SELECT * FROM empartment";
                $result = mysqli_query($con, $sql);
                $number_of_result = mysqli_num_rows($result);

                $number_of_pages = ceil($number_of_result / $result_per_page);

                if (!isset($_GET['page'])) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }
                $starting_limit_number = ($page - 1) * $result_per_page;
                
                //Search button code
                if (isset($_GET['search'])) {
                    $search = $_GET['search'];
                    $query = "SELECT * FROM Employee JOIN empartment ON employee.EmpId = empartment.EmpId JOIN department ON department.DeptId = empartment.DeptId WHERE employee.name='$search' or employee.empid = '$search' or employee.email = '$search' or employee.mobile = '$search' or department.DeptName = '$search' or department.DeptLocation = '$search'  or department.DeptId = '$search'";
                } else {
                //Paignation query
                    $query = "SELECT employee.EmpId, employee.Name, employee.Email, employee.Mobile, department.DeptId, department.DeptName, department.DeptLocation, empartment.empartment_id FROM Employee JOIN empartment ON empartment.EmpId = employee.EmpId JOIN department ON department.DeptId = empartment.DeptId ORDER BY employee.EmpId DESC LIMIT  $starting_limit_number , $result_per_page  ";
                }

                // Table code
                $result = mysqli_query($con, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id =  $row['EmpId'];
                        $name = $row['Name'];
                        $email = $row['Email'];
                        $mobile =  $row['Mobile'];
                        $deptid = $row['DeptId'];
                        $department = $row['DeptName'];
                        $location = $row['DeptLocation'];
                        $empartment_id = $row['empartment_id'];

                        echo '<tr>
                    <th>' . $id . '</th>
                    <td>' . $name . '</td>
                    <td>' . $email . '</td>
                    <td>' . $mobile . '</td>
                    <td>' . $deptid . '</td>
                    <td>' . $department . '</td>
                    <td>' . $location . '</td>
                    
                    <td><a href="update.php?empid=' . $id . '&empartmentid=' . $empartment_id . '" class="text-light"><button class="btn btn-primary ">Update</button></a>
                    <a href="delete.php?empid=' . $id . '&empartmentid=' . $empartment_id . '" class="text-light"><button class="btn btn-danger">Delete</button></a></td>
                </tr>';
                    }
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination Buttons -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php for ($page = 1; $page <= $number_of_pages; $page++) { ?>
                    <?php
                    if (isset($_GET['page'])) {
                        $active =  ($_GET['page'] == $page) ? 'active' : '';
                    }
                    ?>
                    <li class="page-item <?= $active ?>"><a class="page-link" href="view.php?page=<?= $page ?>"><?= $page ?></a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</body>

</html>