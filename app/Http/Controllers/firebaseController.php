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
}
