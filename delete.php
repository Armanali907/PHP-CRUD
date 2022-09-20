<?php
include 'connection.php';

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $query = "delete from Employee where id=$id";
    $result = mysqli_query($con, $query);
    if($result){
        header('Location: view.php');
    }
}
