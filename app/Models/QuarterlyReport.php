<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class QuarterlyReport extends Model
{
    use HasFactory;
    public $table='quarterly_report';
    public $guarded=[];

    public function reportName():HasOne{
        return $this->hasOne(ReportRef::class,'id','report_id');
    }
}
