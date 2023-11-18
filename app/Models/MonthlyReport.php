<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MonthlyReport extends Model
{
    use HasFactory;
    public $table='monthly_report';
    public $guarded=[];

    public function levelName():HasOne{
        return $this->hasOne(Level::class,'id','level_id');
    }
    public function periodeName():HasOne{
        return $this->hasOne(Periode::class,'id','periode_id');
    }
    public function monevMonthly():HasMany{
        return $this->hasMany(MonevMonthly::class,'report_id','id');
    }
}
