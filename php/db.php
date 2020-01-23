<?php

function Createdb(){
    $server="localhost";
    $username="root";
    $password="";
    $dbname="store";
    
    //create connection
    $con=mysqli_connect($server,$username,$password);
    
    //connection checking
    if(!$con)
    {
        die("Connection Failed :".mysqli_connect_error());
    }


    //create database

    $sql="CREATE DATABASE IF NOT EXISTS $dbname";

    if(mysqli_query($con,$sql))
    {
       $con = mysqli_connect($server,$username,$password,$dbname);

        $query="
            CREATE TABLE IF NOT EXISTS books(
            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            book_name VARCHAR(25) NOT NULL,
            book_publisher VARCHAR(20),book_price FLOAT
        );
        ";
        
        
        if(mysqli_query($con,$query))
        {
            return $con;
        }
        else
        {
            echo "Cannot Create table...!";
        }

    }
    else
    {
        echo "Error while creating database".mysqli_error($con);
    }

}