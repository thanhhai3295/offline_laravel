<?php

namespace App\Models;

use App\Models\DashboardModel;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class DashboardModel extends AdminModel
{
    public function countItems($params = null,$options = null) {
    $arrTable = ['user','category','menu','slider','article'];
    $result = [];
    foreach ($arrTable as $key => $value) {
        $tmp = DB::table($value)->count();       
        $result[$value] = $tmp;
    }
    return $result;
    }
}
