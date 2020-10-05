<?php

function orderByFilter(&$data, $filter)
{
    $orderArray = [];

    switch($filter) 
    {
        case 'lucas' :
            $orderArray[0] = $data[3];
            $orderArray[1] = $data[4];
            $orderArray[2] = $data[5];
            $orderArray[3] = $data[0];
            $orderArray[4] = $data[1];
            $orderArray[5] = $data[2];
        break;

        case 'release' :
            // Padrao
        break;

        case 'rinster' :
            $orderArray[0] = $data[0];
            $orderArray[1] = $data[1];
            $orderArray[2] = $data[3];
            $orderArray[3] = $data[4];
            $orderArray[4] = $data[5];
            $orderArray[5] = $data[2];
        break;

        case 'machete' :
            $orderArray[0] = $data[0];
            $orderArray[1] = $data[1];
            $orderArray[2] = $data[4];
            $orderArray[3] = $data[5];
            $orderArray[4] = $data[2];
            $orderArray[5] = $data[3];
        break;

        case 'magnotta' :
            $orderArray[0] = $data[0];
            $orderArray[1] = $data[1];
            $orderArray[2] = $data[3];
            $orderArray[3] = $data[4];
            $orderArray[4] = $data[5];
            $orderArray[5] = $data[2];
        break;

        case 'lee' :
            // Padrao
        break;
    }

    return $orderArray;
}