<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{
    const GOOGLE_BOOKS_API_BASE_URI = 'https://www.googleapis.com/books/v1/volumes';

    public function index(): View
    {
        return view('welcome');
    }

    public function fetchBooks(Request $request)
    {
        $params = [
            'q' => $request->term,
            'maxResults' => 8,
            'Key' => 'AIzaSyB2lJykSOszOVQx3vsQs60yajFsUS14j1Y'
        ];

        $client = new Client();
        $url = self::GOOGLE_BOOKS_API_BASE_URI . '?' . http_build_query($params);
        $response = $client->request('GET', $url);
        return response()->make($response->getBody());
    }

}
