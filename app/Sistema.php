<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sistema extends Model
{
    protected $table='SISTEMA';
    protected $fillable=[
        'ssl'
    ];
    public $timestamps=false;

}
