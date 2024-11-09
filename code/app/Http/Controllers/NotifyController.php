<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\NotifyInterface;

class NotifyController extends Controller
{
    //
    public function addNotify(NotifyInterface $noti, Request $request)
    {
        $result = $noti->addNotify($request);
        return response()->json([
            'message' => $result,
        ], 201);
    }
}
