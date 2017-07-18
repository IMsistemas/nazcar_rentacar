<?php

namespace App\Models\ModeloAuto;

use Illuminate\Database\Eloquent\Model;

class Carmodel extends Model
{
    protected $table = "carmodel";

    protected $primaryKey = "idcarmodel";

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'idcarmodel',
        'namecarmodel',
        'state'
    ];
}
