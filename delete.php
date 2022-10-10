<?php
include 'connection.php';

if (isset($_GET['empid'])) {
    $id = $_GET['empid'];
    $empartment_id= $_GET['empartmentid'];
    $page = $_GET['page'];
    $query = " DELETE em from employee as e join empartment as em on e.EmpId = em.EmpId where em.empartment_id = $empartment_id";
    $result = mysqli_query($con, $query);
    if ($result) {
        header('Location: view.php');
    }
}
