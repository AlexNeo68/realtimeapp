<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * @OA\Info(
     *     title="Laravel Swagger API documentation example",
     *     version="1.0.0",
     *     @OA\Contact(
     *         email="admin@example.com"
     *     ),
     *     @OA\License(
     *         name="Apache 2.0",
     *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *     )
     * )
     * @OA\Tag(
     *     name="Pages",
     *     description="Some example pages",
     * )
     * @OA\Server(
     *     description="Laravel Swagger API server",
     *     url="http://localhost/api"
     * )
     * @OA\SecurityScheme(
     *     type="apiKey",
     *     in="header",
     *     name="X-APP-ID",
     *     securityScheme="X-APP-ID"
     * )
     */
}
