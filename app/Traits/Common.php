<?php

namespace App\Traits;


use Illuminate\Support\Carbon;

trait Common {

   public function getMonthNames(){

    $month_numbers=[1,2,3,4,5,6,7,8,9,10,11,12];
    $month_names=[];
    foreach($month_numbers as $month_number){
        $month_name=Carbon::createFromDate(Carbon::now()->format('Y'),$month_number,1)->isoFormat('MMMM');
        $month_names[]=['month_number'=>$month_number,'month_name'=>$month_name];
    }

       return $month_names;
   }

   public function getYearArray(){

        $yearNow=Carbon::now()->format('Y');
        $yearArray=[];
        for($i=0;$i<10;$i++){
            $yearArray[]=$yearNow-$i;
        }
       return $yearArray;
   }
}