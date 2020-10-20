<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
            'key' => config('GOOGLE_BOOKS_API_KEY')
        ];

        //$response = Http::get(self::GOOGLE_BOOKS_API_BASE_URI . '?' . http_build_query($params));
        //$response = http_get(self::GOOGLE_BOOKS_API_BASE_URI . '?' . http_build_query($params));

        $client = new \GuzzleHttp\Client();
        $temp = self::GOOGLE_BOOKS_API_BASE_URI . '?' . http_build_query($params);
        $response = $client->request('GET', $temp);
        return response()->json($response);
    }

}
