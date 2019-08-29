<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ssl extends Model
{
    protected $table="ssl";
    protected $fillable=[
        'link',
        'resp',
        'estado'
    ];
    public $timestamps=false;
}
