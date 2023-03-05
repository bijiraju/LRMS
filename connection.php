<?php 
    // session_start();
    $dsn="mysql:host=localhost;
    dbname=lrms_db";
    $user="root";
    $password='';
    $options=[];
    try
    {  
        $connection= new PDO($dsn,$user,$password,$options);//path established saved into a variable
        echo "Connection Successfull";
    }
    catch (PDOException)
    {
        echo "Connection Failed";
    }
?>