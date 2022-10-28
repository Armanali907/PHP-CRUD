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
                    <th scope="col">Emp ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Department</th>
                    <th scope="col">Operation</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                // if( isset($_GET['search'])){
                //  //for search and pagination
                // }
                
                // if( isset($_GET['search'])){
                //     $search = $_GET['search'];
                //    $sql =  "SELECT * FROM employee JOIN designation ON employee.emp_id = designation.emp_id JOIN department ON department.dept_id = designation.dept_id WHERE employee.name='$search' or employee.emp_id = '$search' or employee.email = '$search' or employee.mobile = '$search' or department.dept_name = '$search' or department.dept_location = '$search'  or department.dept_id = '$search'";
                // } else {
                
                // }

                //pagination logic code
                $result_per_page = 5;
                $sql = "SELECT * FROM Employee";
                $result = mysqli_query($con, $sql);
                $number_of_result = mysqli_num_rows($result);

                $number_of_pages = ceil($number_of_result / $result_per_page);
                if (!isset($_GET['page'])) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }
                $starting_limit_number = ($page - 1) * $result_per_page;
                // $department_str = '';
                // for(){
                //     $department_str = $department_str + $dept 
                //      if( $ >2){
                //         $department_str = $department_str+','+$dept
                //      }
                // }
                // dept = "deve";
                // $dpe = "deve,tester"
                //Search button code
                if (isset($_GET['search'])) {
                    $search = $_GET['search'];
                    $query = "SELECT * FROM employee JOIN Designation ON employee.emp_id = designation.emp_id JOIN department ON department.dept_id = designation.dept_id WHERE employee.name='$search' or employee.emp_id = '$search' or employee.email = '$search' or employee.mobile = '$search' or department.dept_name = '$search' or department.dept_location = '$search'  or department.dept_id = '$search'";
                } else {
                    //Paignation query
                    // $query = "SELECT employee.emp_id, employee.name, employee.email, employee.mobile, department.dept_id, department.dept_name, department.dept_location, designation.designation_id FROM employee JOIN designation ON designation.emp_id = employee.emp_id JOIN department ON department.dept_id = designation.dept_id ORDER BY employee.emp_id DESC LIMIT  $starting_limit_number , $result_per_page  ";
                    $query = "SELECT * FROM employee LIMIT  $starting_limit_number, $result_per_page  ";
                }
                // Table code
                $result = mysqli_query($con, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id =  $row['emp_id'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $mobile =  $row['mobile'];
                        // $dept_id = $row['dept_id'];
                        // $department = $row['dept_name'];
                        // $location = $row['dept_location'];
                        //  $designation_id = $row['designation_id'];
                        $designation_id = '';         
                    $des_query = "SELECT dept_id FROM `designation` WHERE emp_id=$id";
                    $result_des = mysqli_query($con, $des_query);
                    // var_dump($result_des);  
                    $des_dept = [];
                    while($row2 = mysqli_fetch_assoc($result_des)){
                       $des_dept[] = $row2['dept_id'];
                    }
                    $dept_string = '';
                    $i=1;
                    foreach($des_dept as $depart){
                        $dept_name_query = "SELECT dept_name FROM `department` WHERE dept_id=$depart";
                        $res_depart = mysqli_query($con, $dept_name_query);
                        
                        while($row3 = mysqli_fetch_assoc($res_depart)){
                            if( $i != 1 ){
                                $dept_string = $dept_string.', '.$row3['dept_name'];
                            } else {
                                $dept_string = $dept_string.$row3['dept_name'];
                            }
                            $i++;
                        }
                    }
                    // echo $dept_string;
                    echo '<tr>
                    
                    <th>' . $id . '</th>
                    <td>' . $name . '</td>
                    <td>' . $email . '</td>
                    <td>' . $mobile . '</td>
                    <td>' . $dept_string . '</td>
                    
                    <td><a href="update.php?emp_id=' . $id . '&designation_id=' . $designation_id . '" class="text-light"><button class="btn btn-primary ">Update</button></a>
                    <a href="delete.php?emp_id=' . $id . '&designation_id=' . $designation_id . '" class="text-light"><button class="btn btn-danger">Delete</button></a></td>
                </tr>';
                    }
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination Buttons -->
        <?php if($number_of_pages > 1){ ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php for ($page = 1; $page <= $number_of_pages; $page++) {
                    if (isset($_GET['page'])) {
                        $active =  ($_GET['page'] == $page) ? 'active' : '';
                    } elseif( $page == 1 ) {
                        $active = 'active';
                    }
                     else {
                        $active ='';
                    }
                    ?>

                <?php 
                        $href = '';
                        if(isset( $_GET['search'])){
                            $href='search='.$search.'&page='.$page;
                        } else {
                            $href='page='.$page;
                        }


                    ?>
                <li class="page-item <?= $active ?>"><a class="page-link"
                        href="view.php?<?php echo $href ?>"><?= $page ?></a></li>
                <?php } ?>
            </ul>
        </nav>
        <?php } ?>
    </div>
</body>

</html>