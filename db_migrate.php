<?php

/**
 * Create Fragment 5 & 6 Tables
 * in Mysql db
 */
function createMysqlF5F6Table($database)
{
    // Mysql Connection
    $host = $database['mysql']['host'];
    $user = $database['mysql']['username'];
    $pass = $database['mysql']['password'];
    $dbname = $database['mysql']['database'];

    $conn = mysqli_connect($host, $user, $pass, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed in creating Mysql: " . $conn->connect_error);
    }

    $fragment5 = "
     CREATE TABLE F5(
        id INT AUTO_INCREMENT,
        region VARCHAR(20) NOT NULL,
        country_name VARCHAR(20) NOT NULL,
        primary key (id));
        ";

    $fragment6 = "
     CREATE TABLE F6(
        id INT AUTO_INCREMENT,
        cid INT NOT NULL,
        covid_cases INT NOT NULL,
        male INT NOT NULL,
        female INT NOT NULL,
        primary key (id));
        ";

    if (
        mysqli_query($conn, $fragment5) &&
        mysqli_query($conn, $fragment6)
    ) {
        echo "\n Table F5 created successfully \n";
    } else {
        echo "\n Table F5 is not created successfully \n";
    }
    mysqli_close($conn);
}

/**
 * Create Fragment 1,2,3 & 4
 * in Postgres db
 */
function createPsqlF1F2F3F4Table($database)
{
    // Postgress Connection
    $psqlHost = "host =". $database['pgsql']['host'];
    $psqlPort = "port = ". $database['pgsql']['port'];
    $psqlDbname = "dbname = ". $database['pgsql']['database'];
    $credentials = "user = ". $database['pgsql']['username'] ." password=". $database['pgsql']['password'];

    $db = pg_connect( "$psqlHost $psqlPort $psqlDbname $credentials");

    if (!$db) {
        echo "Error : Unable to open database in seeding Postgres\n";
    } else {
        echo "Opened database successfully\n";
    }
    
       $sql = <<<EOF
       CREATE TABLE F1
       (ID INT PRIMARY KEY NOT NULL,
       REGION TEXT NOT NULL,
       COUNTRY_NAME TEXT NOT NULL);
       CREATE TABLE F3
       (ID INT PRIMARY KEY NOT NULL,
       REGION TEXT NOT NULL,
       COUNTRY_NAME TEXT NOT NULL);
       CREATE TABLE F2
       (ID INT PRIMARY KEY NOT NULL,
       CID INT NOT NULL,
       COVID_CASES INT NOT NULL,
       MALE INT NOT NULL,
       FEMALE INT NOT NULL);
       CREATE TABLE F4
       (ID INT PRIMARY KEY NOT NULL,
       CID INT NOT NULL,
       COVID_CASES INT NOT NULL,
       MALE INT NOT NULL,
       FEMALE INT NOT NULL);
      EOF;
 
       $sql2 = <<<EOF
          CREATE TABLE F2
          (ID INT PRIMARY KEY NOT NULL,
          CID INT NOT NULL,
          COVID_CASES INT NOT NULL,
          MALE INT NOT NULL,
          FEMALE INT NOT NULL);
       EOF;
 
    $ret = pg_query($db, $sql);
    // $ret2 = pg_query($db, $sql2);
    // if(!$ret && !$ret2)  {
    if(!$ret)  {
       echo pg_last_error($db);
    } else {
       echo "Tables created successfully\n";
    }
    pg_close($db);
}
