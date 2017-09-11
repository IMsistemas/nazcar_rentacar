<?php

namespace App\Models\Rent;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $table = "rent";

    protected $primaryKey = "idrent";

    public $incrementing = true;

    public $timestamps = true;
}
