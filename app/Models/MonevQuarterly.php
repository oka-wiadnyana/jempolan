<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonevQuarterly extends Model
{
    use HasFactory;
    public $table='monev_quarterly';
    public $guarded=[];
}
