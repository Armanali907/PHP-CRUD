<?php
include 'connection.php';

if (isset($_GET['emp_id'])) {
    $id = $_GET['emp_id'];
    $designation_id= $_GET['designation_id'];
    
    $query = " DELETE employee FROM employee JOIN designation ON employee.emp_id = designation.emp_id WHERE employee.emp_id = $id";
    $result = mysqli_query($con, $query);
    if ($result) {
        header('Location: view.php');
    }
}
