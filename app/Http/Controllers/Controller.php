<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @SWG\Swagger(
 *     basePath="/api",
 *     schemes={"http"},
 *     @SWG\Info(
 *         version="1.0",
 *         title="Patient Tracker App",
 *         @SWG\Contact(name="Mahmoud Mohamed",email="m.mohamed@cat.com.eg",url="https://www.linkedin.com/in/mahmoud-mohamed-955932b5/"),
 *     ),
 *     @SWG\SecurityScheme(
 * 			securityDefinition="jwt",
 * 			description="Value: Bearer \<token\><br><br>",
 * 			type="apiKey",
 * 			name="Authorization",
 * 			in="header",
 * 		),
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $api_paginate_num = 10;
    public $web_paginate_num = 10;

    public function responseJson($message,$status)
    {
        $result = [
            'type' => request()->fullUrl(),
            'title' => $message,
        ];
        return response()->json($result , $status);
    }
}
