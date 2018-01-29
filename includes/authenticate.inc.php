<?php 

if(!isset($_SESSION['customer'])){
    header('location:account/login.php');
}

?>