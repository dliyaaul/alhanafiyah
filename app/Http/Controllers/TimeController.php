<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class TimeController extends Controller
{
    public function getServerTime()
    {
        return response()->json([
            'serverTime' => Carbon::now()->toDateTimeString(),
        ]);
    }
}
