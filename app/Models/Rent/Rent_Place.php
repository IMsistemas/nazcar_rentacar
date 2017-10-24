<?php

namespace App\Models\Rent;

use Illuminate\Database\Eloquent\Model;

class Rent_Place extends Model
{
    protected $table = 'rent_place';

    protected $primaryKey = false;

    public $incrementing = false;

    public $timestamps = false;
}
