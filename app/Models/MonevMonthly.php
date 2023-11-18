<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonevMonthly extends Model
{
    use HasFactory;
    public $table='monev_monthly';
    public $guarded=[];
}
