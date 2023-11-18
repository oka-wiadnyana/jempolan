<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WeeklyReport extends Model
{
    use HasFactory;
    public $table='weekly_report';
    public $guarded=[];

    public function levelName():HasOne{
        return $this->hasOne(Level::class,'id','level_id');
    }
    public function periodeName():HasOne{
        return $this->hasOne(Periode::class,'id','periode_id');
    }
    public function monevWeekly():HasMany{
        return $this->hasMany(MonevWeekly::class,'report_id','id');
    }
}
