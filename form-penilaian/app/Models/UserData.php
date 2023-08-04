<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserData extends Model
{
    public static function DataUser ($inp) { 
        $tarik = DB::connection('mysql')->select("SELECT * 
        FROM users 
        where email = '".$inp['email']."'"); 
        return $tarik; 
    }
}