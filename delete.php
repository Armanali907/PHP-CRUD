<?php
include 'connection.php';

if (isset($_GET['emp_id'])) {
    $id = $_GET['emp_id'];
    $designation_id= $_GET['designation_id'];
    $page = $_GET['page'];
    $query = " DELETE designation FROM employee JOIN designation ON employee.emp_id = designation.emp_id WHERE designation.designation_id = $designation_id";
    $result = mysqli_query($con, $query);
    if ($result) {
        header('Location: view.php');
    }
}
