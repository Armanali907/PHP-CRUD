<?php
include 'connection.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = " delete em,e from employee as e join empartment as em on e.EmpId = em.EmpId where e.EmpId = $id";
    $result = mysqli_query($con, $query);
    if ($result) {
        header('Location: view.php');
    }
}
