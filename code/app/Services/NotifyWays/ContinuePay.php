<?php

namespace App\Services\Restaurants;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Meal;
use App\Models\Restaurant;
use Carbon\Carbon;
use App\Services\Restaurants\Librarys\RestaurantLibrary;
use App\Contracts\NotifyInterface;

class ContinuePay implements NotifyInterface
{

    public function addNotify() {}
}
