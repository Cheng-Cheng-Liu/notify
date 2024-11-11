<?php

namespace App\Contracts;

interface NotifyInterface
{

    // add notify to database

    public function addNotify(array $request);
    public function updateNotify(array $request);
    public function deleteNotify(array $request);
}
