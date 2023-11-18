<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pejabat extends Model
{
    use HasFactory;
    public $table="pejabat";
    public $guarded=[];

    public function jabatanName():HasOne{
        return $this->hasOne(RefJabatan::class,'id','jabatan_id');
    }
}
