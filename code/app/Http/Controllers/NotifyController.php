<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\NotifyInterface;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotifyController extends Controller
{
    //
    public function addNotify(NotifyInterface $noti, Request $request)
    {
        $data = $request->all();

        $result = $noti->addNotify($data);
        return response()->json([
            'message' => $result,
        ], 201);
    }

    public function countUnresdNotify()
    {
        $user_id = Auth::user()->id;
        $count = Notification::where('user_id', $user_id)
            ->where('status', 0)
            ->count();
        return response()->json([
            'message' => $count,
        ], 201);
    }

    public function myNotifications()
    {
        $user_id = Auth::user()->id;
        $myNotifications = Notification::where('user_id', $user_id)->select('id', 'title')->get()->toArray();
        return response()->json([
            'message' => $myNotifications,
        ], 201);
    }

    public function notification($id)
    {

        //設置已讀
        Notification::where('id', $id)->update(['status' => 1]);
        //詳細內容
        $notification = Notification::where('id', $id)->first();
        return response()->json([
            'message' => $notification,
        ], 201);
    }
}
