<?php
/**
 * Created by Carlos Magno
 * User: Carlos Magno
 * Contact: cmagnosoares@gmail.com
 * Github: https://github.com/xxMAGRAOxx
 *
 */

// ------------------------------------------------------------------------

require_once( __DIR__ . '/../config.php');
require(__DIR__ . '/../libraries/Json/Validator.php');
require(__DIR__ . '/../models/movies.php');
require(__DIR__ . '/../vendor/autoload.php');

switch ($_SERVER["REQUEST_METHOD"]) {
	case 'GET':
		if ($filter = $_GET['filter']) 
		{
			$response = getMovie($filter);

			$results = $response['results'];

			orderByFilter($results, $filter);

			setOutput($results);
		}
		else
			echo 'Erro';
		break;
	default:
		echo 'Erro';
		break;
}

function getMovie($filter)
{
	try
    {
        $movies = new \ClientSide\Movies();

        $movies->verbose(false);

        $movies->filter($filter);	
		
		return $movies->get();		

    }
    catch(Exception $e)
    {
        die($e->getMessage());
	}
	

}

function setOutput($output)
{
	header('Content-Type: application/json');

	echo json_encode($output, JSON_PRETTY_PRINT);

}