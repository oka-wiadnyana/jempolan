<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class ObjectMonevWeekly extends Model
{
    use HasFactory;
    public $table='object_monev_weekly';
    public $guarded=[];

    public function reportName():BelongsTo{
        return $this->belongsTo(ReportRef::class,'report_id','id');
    }

    public function periodeName():HasOneThrough{
        return $this->hasOneThrough(Periode::class,ReportRef::class,'id','id', 'report_id','periode');
    }
    public function levelName():HasOneThrough{
        return $this->hasOneThrough(Level::class,ReportRef::class,'id','id', 'report_id','level_id');
    }

    
}
