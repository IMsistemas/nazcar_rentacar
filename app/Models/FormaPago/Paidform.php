<?php

namespace App\Models\FormaPago;

use Illuminate\Database\Eloquent\Model;

class Paidform extends Model
{
    protected $table = "paidform";

    protected $primaryKey = "idpaidform";

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'idpaidform',
        'namepaidform',
        'state'
    ];
}
