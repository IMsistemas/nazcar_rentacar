<?php

namespace App\Models\Person;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = "person";

    protected $primaryKey = "idperson";

    public $timestamps = true;
}
