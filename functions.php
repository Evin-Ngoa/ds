<?php

/**
 * Finds the relevant queries
 */
function dataLocalizer($algebraicQuery, $query, $ini, $database)
{

	// Get Projection
	$projection = getProjection($algebraicQuery);
	$lastProjStopCount = end($projection);

	// echo "\n <br> ------------------------------------------------------------------------- \n <br>";
	// echo "Projection Below: \n <br>";
	// print_r($projection);
	// echo $lastProjStopCount . "\n <br>";
	// echo "\n <br> ------------------------------------------------------------------------- \n <br>";

	// Get Selection
	$selection = getSelection($algebraicQuery, $lastProjStopCount);
	$lastSelStopCount = end($selection);
	$countryQueryValue = trim(prev($selection));

	// echo "\n <br> ------------------------------------------------------------------------- \n <br>";

	// echo "countryQueryValue ===> " . $countryQueryValue . "\n <br>";
	$site = $ini[$countryQueryValue][0];
	$siteFragment = $ini[$countryQueryValue][1];
	// $site = $ini['Senegal'];

	// echo "Selection Below: \n <br>";
	// print_r($selection);
	// echo "Site = " . $site . "\n <br>";
	// echo "Site Fragment = " . $siteFragment . "\n <br>";

	// echo "\n <br> ------------------------------------------------------------------------- \n <br>";

	// Get Cartesian Product
	$cartesianProduct = getCartesianProduct($algebraicQuery, $lastSelStopCount);
	$lastCartStopCount = end($cartesianProduct);

	// echo "\n <br> ------------------------------------------------------------------------- \n <br>";
	// echo "Cartesian Product Below: \n <br>";
	// print_r($cartesianProduct);
	// echo $lastCartStopCount . "\n <br>";
	// echo "\n <br> ------------------------------------------------------------------------- \n <br>";

	// Display Results
	displayResults($projection, $selection, $siteFragment, $site, $database);
}

/**
 * Dipslay Results
 */
function displayResults($projection, $selection, $siteFragment, $site, $database){
	
	// Delete the last element as it contains count number
	array_pop($projection);
	array_pop($selection);
	$localQuery = localQueryTransformer($projection, $selection, $siteFragment);

	$fragmentsArr = array('f1', 'f2', 'f3', 'f4', 'f5', 'f6');
	$nextFragment = array_search($siteFragment ,$fragmentsArr ,true);
	// echo "\n <br> SEARCH ARRAY LOCATION ==> ". $nextFragment ;
	$nextFragment = $nextFragment + 1;
	// echo "\n <br> NEXT ARRAY LOCATION ==> " . $nextFragment . "\n <br>";

	// echo "Next Fragment ==========______ " . $fragmentsArr[$nextFragment];


	// Mysql
	if ($site == "mysql") {

		$data = queryMysqlDatabase($database, $site, $localQuery);

		// echo "\n <br> DATA ==================== " . $data;
		echo "RESULTS MYSQL BELOW\n <br>";
		echo "===============================\n <br>";
		// print_r($data);
        // echo count($data);
        echo "\n <br> LOCAL QUERY : <b>" . $localQuery . "</b> <br>";

		while ($row = mysqli_fetch_assoc($data)) {
			$countryId = $row["cid"];

			$localForeignQuery = localQueryForeignKeyTransformer($projection, $selection, $fragmentsArr[$nextFragment], $countryId);
			echo "\n <br> LOCAL Next QUERY : <b>" . $localForeignQuery ."</b> \n <br>";

			$dataF = queryMysqlDatabase($database, $site, $localForeignQuery);
			while ($foreign_row = mysqli_fetch_assoc($dataF)) {

                echo "<tr>";                          
                    echo "<td>";
                        echo "<div class='text-muted'>" . $row["cid"] . "</div>";
                    echo "</td>";
                    echo "<td>";
                        echo "<div class='text-muted'>" . $row["region"] . "</div>";
                    echo "</td>";
                    echo "<td>";
                        echo "<div class='text-muted'>" . $row["country_name"] . "</div>";
                    echo "</td>";
                    echo "<td>";
                        echo "<div class='text-muted'>" . $foreign_row["covid_cases"] . "</div>";
                    echo "</td>";
                    echo "<td>";
                        echo "<div class='text-muted'>" . $foreign_row["male"] . "</div>";
                    echo "</td>";
                    echo "<td>";
                        echo "<div class='text-muted'>" . $foreign_row["female"] . "</div>";
                    echo "</td>";
                
                    echo "</tr>";
			}

		}

		// echo "===============================\n <br>";
	} else {
		$data = queryPgsqlDatabase($database, $site, $localQuery);

		// echo "\n <br> DATA ==================== " . $data;
		echo "\n <br> RESULTS PGSQL BELOW \n <br>";
        echo "===============================\n <br>";
        
        echo "\n <br> LOCAL QUERY : <b>" . $localQuery . "</b> <br>";

		while ($row = pg_fetch_row($data)) {
			$countryId = $row[0];

			$localForeignQuery = localQueryForeignKeyTransformer($projection, $selection, $fragmentsArr[$nextFragment], $countryId);
			echo "\n <br> LOCAL Next QUERY : <b>" . $localForeignQuery ."</b> \n <br>";
	
			$dataF = queryPgsqlDatabase($database, $site, $localForeignQuery);
			while ($foreign_row = pg_fetch_row($dataF)) {
                
                echo "<tr>";                          
                echo "<td>";
                    echo "<div class='text-muted'>" . $row[0] . "</div>";
                echo "</td>";
                echo "<td>";
                    echo "<div class='text-muted'>" . $row[1] . "</div>";
                echo "</td>";
                echo "<td>";
                    echo "<div class='text-muted'>" . $row[2] . "</div>";
                echo "</td>";
                echo "<td>";
                    echo "<div class='text-muted'>" . $foreign_row[1] . "</div>";
                echo "</td>";
                echo "<td>";
                    echo "<div class='text-muted'>" . $foreign_row[2] . "</div>";
                echo "</td>";
                echo "<td>";
                    echo "<div class='text-muted'>" . $foreign_row[3] . "</div>";
                echo "</td>";
            
                echo "</tr>";
			}
		}
		// echo "===============================\n <br>";
	}
}

/**
 * Query Pgsql Database
 */
function queryPgsqlDatabase($database, $site, $localQuery)
{

	// PGSQL
	$psqlHost = "host =" . $database['pgsql']['host'];
	$psqlPort = "port = " . $database['pgsql']['port'];
	$psqlDbname = "dbname = " . $database['pgsql']['database'];
	$credentials = "user = " . $database['pgsql']['username'] . " password=" . $database['pgsql']['password'];

	$db = pg_connect("$psqlHost $psqlPort $psqlDbname $credentials");

	if (!$db) {
		echo "\n <br> Error : Unable to open database in seeding Postgres\n <br>";
	}

	$results = pg_query($db, $localQuery);
	if(!$results) {
	   echo pg_last_error($db);
	   exit;
	} 
	return $results;
}

/**
 * Query Mysql Database
 */
function queryMysqlDatabase($database, $site, $localQuery)
{
	// IF MYSQL
	if ($site == "mysql") {
		// echo "\n <br> ====================== IN MYSQL ========================== \n <br>";
		// Mysql Connection
		$host = $database['mysql']['host'];
		$user = $database['mysql']['username'];
		$pass = $database['mysql']['password'];
		$dbname = $database['mysql']['database'];

		// $mysqli = new mysqli($host, $user, $pass, $dbname);

		// if ($mysqli->connect_errno) {
		// 	echo "Failed to connect to MySQL: " . $mysqli->connect_error;
		// 	exit();
		// }

		// $result = $mysqli->query($localQuery);

		// $row = $result->fetch_array(MYSQLI_ASSOC);

		// return $row;
		$conn = mysqli_connect($host, $user, $pass, $dbname);

		if (!$conn) {
			die('Could not connect: ' . mysqli_error());
		}

		$resultRaw = mysqli_query($conn, $localQuery);

		if (mysqli_num_rows($resultRaw) > 0) {
			return $resultRaw;
		} else {
			return '0';
		}
	}

	// PGSQL
	$psqlHost = "host =" . $database['pgsql']['host'];
	$psqlPort = "port = " . $database['pgsql']['port'];
	$psqlDbname = "dbname = " . $database['pgsql']['database'];
	$credentials = "user = " . $database['pgsql']['username'] . " password=" . $database['pgsql']['password'];

	$db = pg_connect("$psqlHost $psqlPort $psqlDbname $credentials");

	if (!$db) {
		echo "\n <br> Error : Unable to open database in seeding Postgres\n <br>";
	} else {
		echo "\n <br> Opened database successfully\n <br>";
	}
	return "Not Yet";
}

/**
 * Coverts Algebraic Query into calculus local query
 */
function localQueryTransformer($projection, $selection, $fragment)
{

	for ($i = 0; $i < sizeof($projection); $i++) {

		if ($projection[$i] == "π") {
			# code...
			$projection[$i] = "SELECT";
		} elseif ($projection[$i] == "*") {
			# code...
		} else {
			// $projection[$i] = "\"".$projection[$i]."\"";
		}
	}
	// echo "+++++++++++++++++++++++++";
	// print_r($selection);

	for ($i = 0; $i < sizeof($selection); $i++) {

		if ($selection[$i] == "σ") {
			# code...
			$selection[$i] = "WHERE";
		}
	}
	$selection[3] = '\'' . $selection[3] . '\'';

	$selection = implode(" ", $selection);
	$projection = implode(" ", $projection);

	$local_query = "" . $projection . " FROM " . $fragment . " " . $selection . "";

	return $local_query;
}

/**
 * Coverts Algebraic Query into calculus local query
 */
function localQueryForeignKeyTransformer($projection, $selection, $fragment, $countryId)
{

	for ($i = 0; $i < sizeof($projection); $i++) {

		if ($projection[$i] == "π") {
			# code...
			$projection[$i] = "SELECT";
		} elseif ($projection[$i] == "*") {
			# code...
		} else {
			// $projection[$i] = "\"".$projection[$i]."\"";
		}
	}
	// echo "+++++++++++++++++++++++++";
	// print_r($selection);

	for ($i = 0; $i < sizeof($selection); $i++) {

		if ($selection[$i] == "σ") {
			# code...
			$selection[$i] = "WHERE";
		}
	}
	$selection[1] = 'cid';
	$selection[3] = $countryId;

	$selection = implode(" ", $selection);
	$projection = implode(" ", $projection);

	$local_query = "" . $projection . " FROM " . $fragment . " " . $selection . "";

	return $local_query;
}


/**
 * Get projection values
 */
function getProjection($algebraicquery)
{
	$projection  = "";
	$i = 0;
	$algebraicquery = Tokenizer($algebraicquery);

	while (($algebraicquery[$i] != "(") and ($i < sizeof($algebraicquery))) {
		$projection = $projection . " " . $algebraicquery[$i];
		// var_dump($algebraicquery[$i]);
		$i = $i + 1;
	}

	$projection = $projection . " " . $i;

	$array = Tokenizer($projection);
	// print_r($array);

	return $array;
}

/**
 * Get selection values
 */
function getSelection($algebraicQuery, $lastStopCount)
{
	$selection = "";
	$lastStopCount = $lastStopCount + 1;

	$algebraicQuery = Tokenizer($algebraicQuery);

	while (($algebraicQuery[$lastStopCount] != "(") and ($lastStopCount < sizeof($algebraicQuery))) {
		$selection = $selection . " " . $algebraicQuery[$lastStopCount];
		if ($lastStopCount < sizeof($algebraicQuery)) {
			$lastStopCount = $lastStopCount + 1;
		}
	}

	$selection = $selection . " " . $lastStopCount;

	$array = Tokenizer($selection);
	// print_r($array);

	return $array;
}

/**
 * Get cartesian product values
 */
function getCartesianProduct($algebraicQuery, $lastStopCount)
{
	$cartesianProduct = "";
	$lastStopCount = $lastStopCount + 1;

	$algebraicQuery = Tokenizer($algebraicQuery);

	while (($algebraicQuery[$lastStopCount] != ")") and ($lastStopCount < sizeof($algebraicQuery))) {
		$cartesianProduct = $cartesianProduct . " " . $algebraicQuery[$lastStopCount];
		if ($lastStopCount < sizeof($algebraicQuery)) {
			$lastStopCount = $lastStopCount + 1;
		}
	}

	$cartesianProduct = $cartesianProduct . " " . $lastStopCount;

	$array = Tokenizer($cartesianProduct);
	// print_r($array);

	return $array;
}


/**
 * Breaks query into idividual tokens
 */
function Tokenizer($sentence)
{
	$tokens = preg_split('/[\s,"]+/', trim($sentence), -1, PREG_SPLIT_NO_EMPTY);
	return $tokens;
}

/**
 * Convert to Algebraic operation
 */
function QueryDecomposer($calculusQuery)
{
	$count = 0;
	$ifProjectionExist = -1;
	$ifCartseianProductExist = -1;


	// Substitute the calculus with algebraic symbols
	for ($count = 0; $count < sizeof($calculusQuery); $count++) {

		// Substitute projection symbol and add flags proj exists
		if ($calculusQuery[$count] == "SELECT") {
			$calculusQuery[$count] = "π";
			$ifProjectionExist = $count;
		}

		// Update existence of cartesian product
		if ($calculusQuery[$count] == "FROM") {
			$ifCartseianProductExist = $count;
		}

		// Substitute selection symbol
		if ($calculusQuery[$count] == "WHERE") {
			$calculusQuery[$count] = "σ";
		}
	}

	// Calculus Validation ; Semantically Analyzer
	$isCalculusValid = semantcAnalyzer($ifProjectionExist, $ifCartseianProductExist);

	if ($isCalculusValid == -1) {
		return -1;
	}
	// Transforms calculus to algebraic query 
	$algebraicQuery = algebraicTransformer($calculusQuery);

	return ($algebraicQuery);
}

/**
 * Traverse through the calculus 
 * query and transform to algebraic query
 */
function algebraicTransformer($calculusQuery)
{

	$projection  = "";
	$cartesianProduct = "";
	$selection = "";
	$index = 0;

	// Concatenate values to FROM which forms the PROJECTION
	while (($calculusQuery[$index] != "FROM") and ($index < sizeof($calculusQuery))) {
		$projection = $projection . " " . $calculusQuery[$index];
		if ($index < sizeof($calculusQuery)) {
			$index = $index + 1;
		}
		// var_dump($projection);
	}

	// SKip FROM statement that we wont need in the algebraic
	$index = $index + 1;

	// Get value between FROM and WHERE Statement
	while (($calculusQuery[$index] != "σ") and ($index < sizeof($calculusQuery))) {
		$cartesianProduct = $cartesianProduct . " " . $calculusQuery[$index];
		if ($index < sizeof($calculusQuery)) {
			$index = $index + 1;
		}
		// var_dump($cartesianProduct);
	}

	// Read everything in σ and after
	while ($index < sizeof($calculusQuery)) {
		$selection = $selection . " " . $calculusQuery[$index];
		if ($index < sizeof($calculusQuery)) {
			$index = $index + 1;
		}
		// var_dump($selection);
	}

	$algebraicQuery =  algebraicFormatter($projection, $selection, $cartesianProduct);

	return $algebraicQuery;
}

/**
 * Checks if the supplied query is valid
 */
function semantcAnalyzer($ifProjectionExist, $ifCartseianProductExist)
{
	// If there is no PROJECTION [SELECT] not valid hence break
	if (($ifProjectionExist == -1) or ($ifProjectionExist > $ifCartseianProductExist)) {
		return -1;
	}

	// If there is no CARTESIAN PRODUCT [SELECT] not valid Calculus hence break 
	if ($ifCartseianProductExist == -1) {
		return -1;
	}
	return 1;
}

/**
 * Formats the final algebraic query
 */
function algebraicFormatter($projection, $selection, $cartesianProduct)
{

	$algFormatted =  $projection . " (" . $selection . " (" . $cartesianProduct . " ) )";

	return $algFormatted;
}
