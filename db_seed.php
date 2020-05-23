<?php

/**
 * Seed Mysql Database for 
 * Fragment 5 and 6
 */
function seedMysqlF5F6Table($database)
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
        die("Connection failed in seeding Mysql: " . $conn->connect_error);
    }

    $f5_sql = "INSERT INTO F5 (id, region, country_name )VALUES(234, 'West', 'Nigeria')";
    $f5_sql2 = "INSERT INTO F5 (id, region, country_name )VALUES(227, 'West', 'Niger')";
    $f5_sql3 = "INSERT INTO F5 (id, region, country_name )VALUES(232, 'West', 'Sierra-Leone')";
    $f5_sql4 = "INSERT INTO F5 (id, region, country_name )VALUES(221, 'West', 'Senegal')";
    $f5_sql5 = "INSERT INTO F5 (id, region, country_name )VALUES(233, 'West', 'Ghana')";

    $f6_sql = "INSERT INTO F6 (cid, covid_cases, male, female)VALUES(234, 6175, 2917, 3258)";
    $f6_sql2 = "INSERT INTO F6 (cid, covid_cases, male, female)VALUES(227, 909, 468, 441)";
    $f6_sql3 = "INSERT INTO F6 (cid, covid_cases, male, female)VALUES(232, 534, 285, 249)";
    $f6_sql4 = "INSERT INTO F6 (cid, covid_cases, male, female)VALUES(221, 2624, 1358, 1266)";
    $f6_sql5 = "INSERT INTO F6 (cid, covid_cases, male, female)VALUES(233, 6100, 2559, 3541)";

    if (
        mysqli_query($conn, $f5_sql) &&
        mysqli_query($conn, $f5_sql2) &&
        mysqli_query($conn, $f5_sql3) &&
        mysqli_query($conn, $f5_sql4) &&
        mysqli_query($conn, $f5_sql5)
    ) {
        $status = 1;
        echo "\n New records f5 created successfully \n";
    } else {
        $status = 0;
        echo "Error: " . mysqli_error($conn);
    }

    if (
        mysqli_query($conn, $f6_sql) &&
        mysqli_query($conn, $f6_sql2) &&
        mysqli_query($conn, $f6_sql3) &&
        mysqli_query($conn, $f6_sql4) &&
        mysqli_query($conn, $f6_sql5)
    ) {
        $status = 1;
        echo "\n New records f6 created successfully \n";
    } else {
        $status = 0;
        echo "Error: " . mysqli_error($conn);
    }

    $conn->close();

    return $status;
}


/**
 * Seed Postgres Fragment 1,2,3 & 4 tables
 * in Postgres db
 */
function seedPsqlF1F2F3F4Table($database)
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
        INSERT INTO F1 (ID,  REGION, COUNTRY_NAME )
        VALUES (254, 'East', 'Kenya' );
        
        INSERT INTO F1 (ID,  REGION, COUNTRY_NAME )
        VALUES (256, 'East', 'Uganda' );
        
        INSERT INTO F1 (ID,  REGION, COUNTRY_NAME )
        VALUES (255, 'East', 'Tanzania' );
        
        INSERT INTO F1 (ID,  REGION, COUNTRY_NAME )
        VALUES (250, 'East', 'Rwanda' );
        INSERT INTO F2 (ID,  CID, COVID_CASES, MALE, FEMALE )
        VALUES (1, 254, 912, 550, 362);
        
        INSERT INTO F2 (ID,  CID, COVID_CASES, MALE, FEMALE )
        VALUES (2, 256, 248, 125, 123);
        
        INSERT INTO F2 (ID,  CID, COVID_CASES, MALE, FEMALE )
        VALUES (3, 255, 509, 351, 158);
        
        INSERT INTO F2 (ID,  CID, COVID_CASES, MALE, FEMALE )
        VALUES (4, 250, 287, 125, 162);
        
        INSERT INTO F3 (ID,  REGION, COUNTRY_NAME )
        VALUES (263, 'South', 'Zimbabwe' );
        
        INSERT INTO F3 (ID,  REGION, COUNTRY_NAME )
        VALUES (27, 'South', 'South-Africa' );
        
        INSERT INTO F3 (ID,  REGION, COUNTRY_NAME )
        VALUES (267, 'South', 'Botswana' );
        
        INSERT INTO F3 (ID,  REGION, COUNTRY_NAME )
        VALUES (258, 'South', 'Mozambique' );
              
        INSERT INTO F4 (ID,  CID, COVID_CASES, MALE, FEMALE )
        VALUES (1, 263, 57, 20, 37);
        
        INSERT INTO F4 (ID,  CID, COVID_CASES, MALE, FEMALE )
        VALUES (2, 27, 16433, 9857, 6576);
        
        INSERT INTO F4 (ID,  CID, COVID_CASES, MALE, FEMALE )
        VALUES (3, 267, 25, 13, 12);
        
        INSERT INTO F4 (ID,  CID, COVID_CASES, MALE, FEMALE )
        VALUES (4, 258, 145, 100, 45);
        
     EOF;

    $ret = pg_query($db, $sql);
    if (!$ret) {
        $status = 0;
        echo pg_last_error($db);
    } else {
        $status = 1;
        echo "Records created successfully\n";
    }
    pg_close($db);
    
    return $status;
}


/**
 * Seed Mysql Database for 
 * Fragment 5 and 6
 */
function seedMysqlCountriesTable($database)
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
        die("Connection failed in seeding Mysql: " . $conn->connect_error);
    }

    $sql_countries = "INSERT INTO sql_countries 
        (cid, region, country_name, covid_cases, male, female )
        VALUES (234, 'West', 'Nigeria', 6175, 2917, 3258),
        (227, 'West', 'Niger', 909, 468, 441),
        (232, 'West', 'Sierra Leone', 534, 285, 249),
        (221, 'West', 'Senegal', 2624, 1358, 1266),
        (233, 'West', 'Ghana', 6100, 2559, 3541)";
    
    // $queryRes = createMysqlFragments($conn);
    $fsql = "create table f5 as select cid, region, country_name from sql_countries where sql_countries.region='West'";
    $fsql2 = "create table f6 as select cid, covid_cases, male, female from sql_countries where sql_countries.region='West'";
    $fsql3 = "create table f8 as select * from f5 inner join f6 using (cid)";

    if (
        mysqli_query($conn, $sql_countries)
        && mysqli_query($conn, $fsql)
        && mysqli_query($conn, $fsql2)
        && mysqli_query($conn, $fsql3)
    ) {
        $status = 1;
        echo "\n New records countries created successfully \n";
    } else {
        $status = 0;
        echo "Error: " . mysqli_error($conn);
    }

    $conn->close();

    return $status;
}


/**
 * Seed Postgres Fragment 1,2,3 & 4 tables
 * in Postgres db
 */
function seedPsqlCountriesTable($database)
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
        INSERT INTO psql_countries (CID, REGION, COUNTRY_NAME, COVID_CASES, MALE, FEMALE)
        VALUES 
        (254, 'East', 'Kenya', 912, 550, 362 ),
        (256, 'East', 'Uganda', 248, 125, 123 ),        
        (255, 'East', 'Tanzania', 509, 351, 158 ),
        (250, 'East', 'Rwanda', 287, 125, 162 ),        
        (263, 'South', 'Zimbabwe', 57, 20, 37 ),        
        (27, 'South', 'South Africa', 16433, 9857, 6576 ),        
        (267, 'South', 'Botswana', 25, 13, 12 ),        
        (258, 'South', 'Mozambique', 145, 100, 45 );
        
     EOF;

    $ret = pg_query($db, $sql);

    $fragRes = createPgsqlFragments($db);

    if (!$ret && !$fragRes) {
        $status = 0;
        echo pg_last_error($db);
    } else {
        $status = 1;
        echo "Records created successfully\n";
    }
    pg_close($db);

    return $status;
}

/**
 * Function to fragment the parent table in PGSQL
 */
function createPgsqlFragments($db){
    // F7 DHF
    $psql = <<<EOF
            create table f1 as select cid, region, country_name from psql_countries where psql_countries.region='East';
            create table f2 as select cid, covid_cases, male, female from psql_countries where psql_countries.region='East';
            create table f3 as select cid, region, country_name from psql_countries where psql_countries.region='South';
            create table f4 as select cid, covid_cases, male, female from psql_countries where psql_countries.region='South';
            create table f7 as select * from f1 inner join f2 using (cid);
    EOF;

    $retPg = pg_query($db, $psql);
    
    return $retPg;
}

/**
 * Function to fragment the parent table in MYSQL
 */
function createMysqlFragments($conn){
    $fsql = "
    create table f5 as select cid, region, country_name from sql_countries where sql_countries.region='West';
    create table f6 as select cid, covid_cases, male, female from sql_countries where sql_countries.region='West';
    create table f8 as select * from f5 inner join f6 using (cid);
    ";

    $res = mysqli_query($conn, $fsql);

    return $res;
}
