<?php
   $database = include('config.php');
   echo "MYSQL = " . $database['mysql']['port']; // 'localhost'
   echo "POSTGRES = " . $database['pgsql']['port']; // 'localhost'
   echo "\n";

$county = "Kenya";

$query = "SELECT * FROM F5 WHERE country_name = ".$county."";


$tokens = Tokenizer($query);

// array(8) { 
//     [0]=> string(6) "SELECT" 
//     [1]=> string(1) "*" 
//     [2]=> string(4) "FROM" 
//     [3]=> string(2) "t1" 
//     [4]=> string(5) "WHERE" 
//     [5]=> string(9) "country_name" 
//     [6]=> string(1) "=" 
//     [7]=> string(7) "Kenya" 
// }
var_dump($tokens);


$algebraicquery =  QueryDecomposer($tokens);

// string(39) " π * ( σ County_Id = Kenya ( t1 ) )"
var_dump($algebraicquery);


/**
 * Breaks query into idividual tokens
 */
function Tokenizer($sentence) 
{
	$tokens = preg_split('/[\s,"]+/', $sentence, -1, PREG_SPLIT_NO_EMPTY);
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
	for ($count=0; $count < sizeof($calculusQuery); $count++) { 

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

	// Calculus Validation
	$isCalculusValid = checkCalculusValidity($ifProjectionExist, $ifCartseianProductExist);

	if($isCalculusValid == -1){
		return -1;
	}
	// Transforms calculus to algebraic query 
	$algebraicQuery = algebraicTransformer($calculusQuery);

	return($algebraicQuery);
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
	while (($calculusQuery[$index] != "FROM") AND ($index < sizeof($calculusQuery)) ) {
		$projection = $projection . " " . $calculusQuery[$index];
		if ($index < sizeof($calculusQuery)) {
			$index = $index + 1;
		}
		// var_dump($projection);
	}

    // SKip FROM statement that we wont need in the algebraic
	$index = $index + 1;
	
	// Get value between FROM and WHERE Statement
	while (($calculusQuery[$index] != "σ") AND ($index < sizeof($calculusQuery)) ) {
		$cartesianProduct = $cartesianProduct . " " . $calculusQuery[$index];
		if ($index < sizeof($calculusQuery)) {
			$index = $index + 1;
		}
		// var_dump($cartesianProduct);
	}

	// Read everything in σ and after
	while ($index < sizeof($calculusQuery) ) {
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
function checkCalculusValidity($ifProjectionExist, $ifCartseianProductExist){
	// If there is no PROJECTION [SELECT] not valid hence break
	if(($ifProjectionExist == -1) OR ($ifProjectionExist > $ifCartseianProductExist)){
		return -1;
	}

	// If there is no CARTESIAN PRODUCT [SELECT] not valid Calculus hence break 
	if($ifCartseianProductExist == -1){
		return -1;
	}
	return 1;
}

/**
 * Formats the final algebraic query
 */
function algebraicFormatter($projection, $selection, $cartesianProduct){

	$algFormatted =  $projection . " (" . $selection . " (" . $cartesianProduct . " ) )";

	return $algFormatted;
}

