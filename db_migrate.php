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
    $status = 0;

    $conn = mysqli_connect($host, $user, $pass, $dbname);

    // Check connection
    if ($conn->connect_error) {
        $status = 0;
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
        $status = 1;
    } else {
        echo "\n Table F5 is not created successfully \n";
        $status = 0;
    }
    mysqli_close($conn);

    return $status;
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
    $status = 0;

    $db = pg_connect( "$psqlHost $psqlPort $psqlDbname $credentials");

    if (!$db) {
        $status = 0;
        echo "Error : Unable to open database in seeding Postgres\n";
    } else {
        $status = 1;
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
        $status = 0;
       echo pg_last_error($db);
    } else {
        $status = 1;
       echo "Tables created successfully\n";
    }
    pg_close($db);

    return $status;
}



/**
 * Create Fragment 5 & 6 Tables
 * in Mysql db
 */
function createMysqlCountriesTable($database)
{
    // Mysql Connection
    $host = $database['mysql']['host'];
    $user = $database['mysql']['username'];
    $pass = $database['mysql']['password'];
    $dbname = $database['mysql']['database'];
    $status = 0;

    $conn = mysqli_connect($host, $user, $pass, $dbname);

    // Check connection
    if ($conn->connect_error) {
        $status = 0;
        die("Connection failed in creating Mysql: " . $conn->connect_error);
    }

    $sql_countries = "
     CREATE TABLE sql_countries 
        (cid INT AUTO_INCREMENT,
        region VARCHAR(20) NOT NULL,
        country_name VARCHAR(20) NOT NULL,                
        covid_cases INT NOT NULL,
        male INT NOT NULL,
        female INT NOT NULL,
        primary key (cid));
        ";

    if (
        mysqli_query($conn, $sql_countries)        
    ) {
        $status = 1;
        echo "\n Table countries created successfully \n";
    } else {
        $status = 0;
        echo "\n Table countries not created! \n";
    }
    mysqli_close($conn);

    return $status;
}

/**
 * Create Fragment 1,2,3 & 4
 * in Postgres db
 */
function createPsqlCountriesTable($database)
{
    // Postgress Connection
    $psqlHost = "host =". $database['pgsql']['host'];
    $psqlPort = "port = ". $database['pgsql']['port'];
    $psqlDbname = "dbname = ". $database['pgsql']['database'];
    $credentials = "user = ". $database['pgsql']['username'] ." password=". $database['pgsql']['password'];
    $status = 0;

    $db = pg_connect( "$psqlHost $psqlPort $psqlDbname $credentials");

    if (!$db) {
        $status = 0;
        echo "Error : Unable to open database in seeding Postgres\n";
    } else {
        $status = 1;
        echo "Opened database successfully\n";
    }
    
       $psql = <<<EOF
       CREATE TABLE PSQL_COUNTRIES 
       (CID INT PRIMARY KEY NOT NULL,
       REGION TEXT NOT NULL,
       COUNTRY_NAME TEXT NOT NULL,
       COVID_CASES INT NOT NULL,
       MALE INT NOT NULL,
       FEMALE INT NOT NULL);
      EOF;
 
   
    $ret = pg_query($db, $psql);    
    if(!$ret)  {
        $status = 0;
       echo pg_last_error($db);
    } else {
        $status = 1;
       echo "Tables created successfully\n";
    }
    pg_close($db);

    return $status;
}
