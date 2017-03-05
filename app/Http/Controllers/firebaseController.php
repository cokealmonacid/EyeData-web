<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class firebaseController extends Controller
{
    public function index()
    {
    	$response = [];

    	$count = 0;

    	$firebase = new \Firebase\Client(env('FIREBASE_URL'));

    	$values = $firebase->child('/data')->get();

    	$keys = array_keys($values);

    	foreach ($keys as $key) {

    		if (strpos($key, '_config')) {

    			$response[$count] = $values[$key];
    			$count++;
    		}
    	}

    	$count = 0;

    	foreach ($response as $data) {

    		$key = array_keys($data);

    		$response[$count] = $data[$key[0]];

    		$count++;
    	}

    	return view('index', compact('response'));
    }

    public function show($testName)
    {
    	$firebase = new \Firebase\Client(env('FIREBASE_URL'));

    	$testInfo = $firebase->child('/data/' . $testName . '_config')->get();

    	$key = array_keys($testInfo);

    	$testInfo = $testInfo[$key[0]];

    	return view('detail', compact('testInfo'));
    }

    public function makeHeatMap($testName)
    {
        $firebase = new \Firebase\Client(env('FIREBASE_URL'));

        $test_data = $firebase->child('/data/' . $testName )->get();

        $keys = array_keys($test_data);

        $fixationPosition = [];

        $cont = 0;

        foreach ($keys as $key) {
            $fixationPosition[$cont] = ($test_data[$key][1]);
            $cont += 1;
        }

        for ($i=0; $i < count($fixationPosition); $i++) {

            $fixationPosition[$i]["x"] = intval(round($fixationPosition[$i]["x"] / 2));
            $fixationPosition[$i]["y"] = intval(round($fixationPosition[$i]["y"] / 2));
        }

        $result = [];

        for ( $i = 0; $i < count($fixationPosition); $i++) {

            $data = $fixationPosition[$i];
            $max = 0;
            $ocurr = 0;

            if ($i != 0) {

                for ($j = 0; $j < count($result); $j++) {
                    $value = $result[$j];
                    if ($value["x"]-2 <= $data["x"] && $data["x"] <= $value["x"]+2) {
                        if ($value["y"]-2 <= $data["y"] && $data["y"] <= $value["y"]+2) {
                            $ocurr += 1;
                        }
                    }
                }
            }

            if ($ocurr == 0) {
                for ( $j = 0; $j < count($fixationPosition); $j++) {
                    $value = $fixationPosition[$j];
                    if ($data["x"]-2 <= $value["x"] && $value["x"] <= $data["x"]+2 ){
                        if ($data["y"]-2 <= $value["y"] && $value["y"] <= $data["y"]+2 ){
                            $max += 1;
                        }
                    }
                }

                $result[count($result)] = [
                    "x" => $data["x"],
                    "y" => $data["y"],
                    "value" => $max,
                    "radius" => 15
                ];
            }
        }

        return $result;
    }
}
