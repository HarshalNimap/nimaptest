<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table='product';
    protected $guarded=['product_id'];
}
