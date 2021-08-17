<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelsController extends Controller
{
    //
    public function index(Request $request) {
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $adults = $request->adults;
        $children = $request->children;
        $childrensAge = $request->childrensAge;
        
        
        
        //$endpoint = "https://hotel.dolli.cloud/api/hotel/avail-rooms?startDate=2021-10-05&endDate=2021-10-08&adults=2&children=0&hotelCode=B5V4&primaryLangId=en&currency=EUR&numRooms=1&theme=null&hotelProvider=0&clientId=mamashelter";
        
        

        $endpoint = "https://hotel.dolli.cloud/api/hotel/avail-rooms?startDate=".$startDate."&endDate=".$endDate."&adults=".$adults."&children=".$children."&hotelCode=B5V4&primaryLangId=en&currency=EUR&numRooms=1&theme=null&hotelProvider=0&clientId=mamashelter";
        
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$endpoint);
        $result=curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        
        $rooms = $result['hydra:member'][0]['roomStays'][0]['roomTypes'];
        
        for ($i=0; $i<sizeof($rooms); $i++){
            $response[$i]['text'] = $result['hydra:member'][0]['roomStays'][0]['roomTypes'][$i]['roomDescription']['text'];
            $response[$i]['maxOccupancy'] = $result['hydra:member'][0]['roomStays'][0]['roomTypes'][$i]['occupancy']['maxOccupancy'];
            $response[$i]['sizeMeasurement'] = $result['hydra:member'][0]['roomStays'][0]['roomTypes'][$i]['sizeMeasurement'];
            $response[$i]['amountAfterTax'] = $result['hydra:member'][0]['roomStays'][0]['roomTypes'][$i]['viewExtensions']['roomRates'][0]['rates'][0]['total']['amountAfterTax'];
            $response[$i]['currencyCode'] = $result['hydra:member'][0]['roomStays'][0]['roomTypes'][$i]['viewExtensions']['roomRates'][0]['rates'][0]['total']['currencyCode'];
        }
        
        
        return $response;
    }
}
