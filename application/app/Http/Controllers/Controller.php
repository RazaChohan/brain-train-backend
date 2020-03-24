<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @param \Exception $exception
     * @param string $callee
     */
    protected function log($exception, $callee) {
        Log::error($exception->getTraceAsString(), [ $callee ]);
    }
}
