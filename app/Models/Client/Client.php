<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = "client";

    protected $primaryKey = "idclient";

    public $timestamps = true;
}
