<?php

namespace App\Http\Controllers;

use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;
use Log;

class SearchController extends Controller
{
    private $elasticSearchClient;

    public function __construct()
    {
        $this->elasticSearchClient = ClientBuilder::create()->build();
    }
    public function search(Request $request)
    {
        $body = $request->all();

        $query = "*" .$body['query']. "*";
        $fields = $body['keys'];

        $params = [
            'index' => 'ticket_index1',
            'body' => [
                "query" => [
                    "query_string" => [
                        "fields"=> $fields,
                        "query" => $query
                    ]
                ]
            ]
        ];

        // Log::info($params);

        $response = $this->elasticSearchClient->search($params);
        return response()->json($response['hits']);
        // dd($response['hits']);
    }
}