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

// DELETE w
// FROM WorkRecord2 w
// INNER JOIN Employee e
//   ON EmployeeRun=EmployeeNo
// WHERE Company = '1' AND Date = '2013-05-06'

// -- Delete data from Table1
// DELETE Table1
// FROM Table1 t1
// INNER JOIN Table2 t2 ON t1.Col1 = t2.Col1
// WHERE t2.Col3 IN ('Two-Three','Two-Four')
// GO