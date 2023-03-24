<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Support\Response;

class ApiController extends Controller
{
    use Swagger;

    protected Response $response;
    protected null|string $resource = null;

    public function __construct()
    {
        $this->response = new Response(response(), $this->resource);
    }

    protected function recordExists($record)
    {
        if (! $record) {
            abort(404);
        }
    }
}
