<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;


class Controller extends BaseController
{
    public function jsonResponse($data)
    {
        return response($data)->header('Content-Type', 'application/json');
    }
}
