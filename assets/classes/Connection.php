<?php

class Connection
{
    public function setConnection()
    {
        include './assets/config.php';

        $con = mysqli_connect($dbhost, $user, $pass, $dbname);

        // Check connection
        if ($con === false) {
            die("Failed to connect to MySQL: " . mysqli_connect_error());
        }

        return $con;
    }
}
