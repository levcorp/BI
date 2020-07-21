<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpeedTest extends Model
{
    protected $table='SPEED_TEST';
    protected $fillable=[
      'ping',
      'download',
      'upload',
      'fecha',
    ];
    public $timestamps = false;

}
