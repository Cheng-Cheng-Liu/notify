<?php

namespace App\Services\NotifyWays;

use App\Contracts\NotifyInterface;
use App\Models\Notification;
use App\Models\User;

class ContinuePay implements NotifyInterface
{

    public function addNotify($request)
    {
        // 寄給所有人所以拿所有人的id
        // return array()
        $users = User::pluck('id')->toArray();
        foreach ($users as $id) {
            Notification::create([

                'user_id' => $id,
                'type' => $request['type'],
                'title' => $request['title'],
                'content' => $request['content'],

            ]);
        }
        return "add notify by ontinuePay";
    }


    public function updateNotify($request)
    {
        $id = $request['id'];
        Notification::where('id', $id)->update([

            'user_id' => $id,
            'type' => $request['type'],
            'title' => $request['title'],
            'content' => $request['content'],

        ]);

        return "update notify by ontinuePay";
    }

    public function deleteNotify($request)
    {

        $id = $request['id'];
        Notification::where('id', $id)->delete();


        return "delete notify by ontinuePay";
    }
}
