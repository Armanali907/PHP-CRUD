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
                    <th scope="col">Password</th>
                    <th scope="col">DeptId</th>
                    <th scope="col">Department</th>
                    <th scope="col">Location</th>
                    <th scope="col">Operation</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // pagination logic
                $result_per_page = 5;

                $sql = "select * from employee";
                $result = mysqli_query($con, $sql);
                $number_of_result = mysqli_num_rows($result);

                $number_of_pages = ceil($number_of_result / $result_per_page);

                if (!isset($_GET['page'])) {

                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }


                $starting_limit_number = ($page - 1) * $result_per_page;



                //Search button logic
                if (isset($_GET['search'])) {
                    $search = $_GET['search'];
                    $query = "select * from employee where name like '%$search%' or email like '%$search%' or empid like '%$search%' or mobile like '%$search%'";
                } else {
                    //Paignation query
                    //$query = "select * from Employee limit " . $starting_limit_number . ',' . $starting_limit_number .;

                }
                $query = "SELECT * FROM employee JOIN empartment ON empartment.EmpId = employee.EmpId JOIN department ON department.DeptId = empartment.DeptId ORDER BY employee.EmpId limit  $starting_limit_number , $result_per_page  ";

                $result = mysqli_query($con, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // echo '<pre>';
                        // var_dump($row);
                        // echo '</pre>';
                        $id =  $row['EmpId'];
                        $name = $row['Name'];
                        $email = $row['Email'];
                        $mobile =  $row['Mobile'];
                        $password =  $row['Password'];
                        $deptid = $row['DeptId'];
                        $department = $row['DeptName'];
                        $location = $row['DeptLocation'];

                     echo '<tr>
                    <th>' . $id . '</th>
                    <td>' . $name . '</td>
                    <td>' . $email . '</td>
                    <td>' . $mobile . '</td>
                    <td>' . $password . '</td>
                    <td>' . $deptid . '</td>
                    <td>' . $department . '</td>
                    <td>' . $location . '</td>
                    
                    <td><a href="update.php?update=' . $id . '" class="text-light"><button class="btn btn-primary ">Update</button></a>
                    <a href="delete.php?delete=' . $id . '" class="text-light"><button class="btn btn-danger">Delete</button></a></td>
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
                    if (isset($_REQUEST['page'])) {
                        $active =  ($_REQUEST['page'] == $page) ? 'active' : '';
                    }
                    ?>
                    <li class="page-item <?= $active ?>"><a class="page-link" href="view.php?page=<?= $page ?>"><?= $page ?></a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</body>

</html>