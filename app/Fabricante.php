<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{
    protected $connection = 'sap';
    protected $table='OMRC';
}
