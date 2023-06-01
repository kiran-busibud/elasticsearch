<?php

use App\Http\Controllers\SearchController;
use App\Http\Controllers\TicketIndexController;
use Illuminate\Support\Facades\Route;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create_index', function () {
    $client = ClientBuilder::create()->build();

    $params = [
        'index' => 'test_index'
    ];
    $response = $client->indices()->create($params);

    return response()->json($response);
});

Route::post('/post_in_test_index', function (Request $request) {
    $client = ClientBuilder::create()->build();

    $body = $request->all();

    $params = [
        'index' => 'test_index',
        'id' => 1,
        'body' => ['name' => $body['name'], 'email' => $body['email']]
    ];

    $response = $client->index($params);
    return response()->json($response);
});

Route::get('/search_in_test_index', function (Request $request) {

    $client = ClientBuilder::create()->build();

    // $body = $request->all();

    $params = [
        'index' => 'test_index',
        'body' => [
            "query" => [
                "query_string" => [
                    "fields" => ["email", "name"],
                    "query" => "*mays*"

                ]
            ]
        ]
    ];

    // $params = [
    //     'index' => 'test_index',
    //     'id'    => 1
    // ];

    $response = $client->search($params);

    dd($response['hits']);
});

Route::get('/get_tickets', [TicketIndexController::class, 'getAllTickets']);

Route::get('/index_tickets', [TicketIndexController::class, 'indexAllTickets']);

Route::get('/search', [SearchController::class, 'search']);