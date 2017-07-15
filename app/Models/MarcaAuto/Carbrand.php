<?php

namespace App\Models\MarcaAuto;

use Illuminate\Database\Eloquent\Model;

class Carbrand extends Model
{
    protected $table = "carbrand";

    protected $primaryKey = "idcarbrand";

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'idcarbrand',
        'namecarbrand',
        'state'
    ];
}
