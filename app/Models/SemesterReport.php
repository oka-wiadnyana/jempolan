<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SemesterReport extends Model
{
    use HasFactory;
    public $table='semester_report';
    public $guarded=[];

    public function reportName():HasOne{
        return $this->hasOne(ReportRef::class,'id','report_id');
    }
}
