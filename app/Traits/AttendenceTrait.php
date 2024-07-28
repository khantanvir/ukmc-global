<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
Use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Login\LoginRequest;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Str;
use App\Models\Course\ClassSchedule;

trait AttendenceTrait{
    
    public static function get_date_format($start_date=NULL,$end_date=NULL){
        if(empty($start_date) || empty($end_date)){
            return false;
        }
        $dates = [];
        for ($date = $start_date->copy(); $date->lte($end_date); $date->addDay()) {
            $dates[] = [
                'date' => $date->toDateString(),
                'weekday' => $date->format('l')
            ];
        }
        return $dates;
    }
    public static function get_schedule_data(Collection $schedules){
        //return $schedules;
        $scheduleData = [];
        foreach ($schedules as $schedule) {
            $startTime = Carbon::parse($schedule->time_from)->format('H:00');
            $endTime = Carbon::parse($schedule->time_to)->format('H:59');
            $scheduleData[$schedule->schedule_date][$startTime][] = $schedule;
        }
        return $schedules;
    }
    
}
