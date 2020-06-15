<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function books(Request $request)
    {
        $base_uri = 'https://www.googleapis.com/books/v1/volumes?q=';
        try {
            $searchAuthor = $request['queryAuthor'];
            $searchTitle = $request['queryTitle'];
            $searchISBN = $request['queryISBN'];
            $plusNeeded = false;
            $client = new Client();// add title query
            if (isset($searchTitle)) {
                $searchTitle = trim($searchTitle);
                $searchTitle = str_replace(' ', '+', $searchTitle);
                $base_uri = $base_uri . $searchTitle;
                $plusNeeded = true;
            }
            if (isset($searchAuthor)) {
                $searchAuthor = trim($searchAuthor);
                $searchAuthor = str_replace(' ', '+', $searchAuthor);
                $base_uri = $base_uri . ($plusNeeded ? '+' : '') . 'inauthor:' . $searchAuthor;
                $plusNeeded = true;
            }
            if (isset($searchISBN)) {
                $base_uri = $base_uri . ($plusNeeded ? '+' : '') . 'isbn:' . $searchISBN;
            }
            $base_uri = $base_uri . '&maxResults=10';
            $base_uri = $base_uri . '&printType=books';
            $base_uri = $base_uri . '&key=' . env('GOOGLE_API_KEY');
            Log::info('Calling ' . $base_uri);
            $response = $client->get($base_uri);
            Log::info($response->getStatusCode());
            $jsonBody = json_decode($response->getBody(), true);
            if ($response->getStatusCode() != 200) {
                return response()->json('Error occured: ' . $response->getStatusCode(), 500);
            } else {
                return response()->json($jsonBody);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json('Internal error occured: ' . $e->getMessage(), 500);
        }
    }
}
