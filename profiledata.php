<?php 

session_start();

 echo 'Name:     '.$_SESSION['name'].'<br>';
 echo 'Email:    '.$_SESSION['email'].'<br>';
 echo 'Address:  '.$_SESSION['address'].'<br>';
 echo 'LinkedIn: '.$_SESSION['linkedIn'].'<br>';


?>