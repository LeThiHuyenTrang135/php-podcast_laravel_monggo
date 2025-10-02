<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Contact extends Model
{
    protected $connection = 'mongodb';    // dùng connection mongodb
    protected $collection = 'contacts';   // tên collection
    protected $fillable = ['first_name','last_name','email','subject','message'];
}
