<!-- Configuration variables for the connection with the database -->

<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "contactsList";
    $dsn = "mysql:host=$host;dbname=$dbname";
    $options = array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                  );
?>