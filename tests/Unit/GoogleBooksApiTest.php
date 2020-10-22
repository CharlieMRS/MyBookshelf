<?php

namespace Tests\Unit;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GoogleBooksApiTest extends TestCase
{
    const GOOGLE_BOOKS_API_BASE_URI = 'https://www.googleapis.com/books/v1/volumes';

    public function testResponse()
    {
        $response = $this->ajaxPost('/fetchBooks', ['term' => 'pumpkins']);
        $response->assertStatus(200);
    }

    public function testBookCount()
    {
        $response = $this->ajaxPost('/fetchBooks', ['term' => 'pumpkins']);
        $this->assertCount(8, json_decode($response)['items']);
    }

    private function ajaxPost($uri, array $data = [])
    {
        return $this->post($uri, $data, ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
    }

}
