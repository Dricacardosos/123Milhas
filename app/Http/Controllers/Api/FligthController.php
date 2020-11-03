<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FligthController extends Controller
{
    public function search()
    {
        $flightsList = curl_init("http://prova.123milhas.net/api/flights");

        curl_setopt($flightsList, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($flightsList, CURLOPT_SSL_VERIFYPEER, false);

        $returnFligths = json_decode(curl_exec($flightsList), false);
        
        $infosGroup = [
            "fligths" => array(),
            "groups" => array(),
            "fligthOut" => array(),
            "fligthIn" => array(),
            "totalGroups" => "",
            "totalFlights" => "",
            "cheapestPrice" => "",
            "cheapestGroup"=> ""
        ];

        foreach ($returnFligths as $obj) 
        {
            array_push($infosGroup["fligths"], $obj->flightNumber);
            
            if($obj->outbound){                
                array_push($infosGroup["fligthOut"], $obj);
            }
            else{
                array_push($infosGroup["fligthIn"], $obj);
            }
        }

        $arrayOutbound = $infosGroup["fligthOut"];
        $arrayInbound = $infosGroup["fligthIn"];

        $group = [];
        $group['uniqueId'] = 0;

        foreach ($arrayOutbound as $fligthOut) {
            $fareOutbound = $fligthOut->fare;
            $priceOutbound = $fligthOut->price;
            
            foreach ($arrayInbound as $fligthIn) {

                $fareInbound = $fligthIn->fare;
                $priceInbound = $fligthIn->price;

                if($fareOutbound == $fareInbound){
                    
                    $group['uniqueId']++;
                    $group['totalPrice'] = $priceOutbound + $priceInbound;
                    $group['outbound'] = $fligthOut;
                    $group['inbound'] = $fligthIn;

                    array_push($infosGroup['groups'],  $group);
                    
                }
            }
        }
        
        sort($infosGroup['groups']);
        $infosGroup['totalGroups'] =  count($infosGroup['groups']);
        $infosGroup['totalFlights'] =  count($infosGroup['fligthOut']) + count($infosGroup['fligthIn']);
        $infosGroup['cheapestPrice'] =  $infosGroup['groups'][0]['totalPrice'];
        $infosGroup['cheapestGroup'] =  $infosGroup['groups'][0]['uniqueId'];

        $jsonFligths = json_encode($infosGroup);

        return $jsonFligths;
    }
}