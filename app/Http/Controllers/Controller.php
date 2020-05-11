<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function addHours($hours,$Am_or_PM,$numberHourstoAdd)
    {   // 9 pm +7 = 4 AM
        // 9 Am +7 = 4PM
        //12 pm +1=1 PM
        if($hours==12)
        {
            if($Am_or_PM=='AM')$Am_or_PM='PM';
            else if($Am_or_PM=='PM')$Am_or_PM='AM';
            return [$numberHourstoAdd,$Am_or_PM];
        }
        $sumhours=  $hours+$numberHourstoAdd;

        if($sumhours>12) {
            $sumhours=$sumhours-12 ;
            if($Am_or_PM=='AM')$Am_or_PM='PM';
            else  if($Am_or_PM=='PM')$Am_or_PM='AM';
        }
        return [$sumhours,$Am_or_PM];
    }
    public function adjustHours($hours,$Am_or_PM,$numberHourstoadjust)
    {
        // 2 pm -7 =  7 am
        //12 PM-1=11 AM
        //12 Am-1=11 PM
        if($hours==12)
        {
            if($Am_or_PM=='AM')$Am_or_PM='PM';
            else if($Am_or_PM=='PM')$Am_or_PM='AM';
            return [12-$numberHourstoadjust,$Am_or_PM];
        }
        $adjhours=  $hours-$numberHourstoadjust;
        if($adjhours==0)
        {
            $adjhours=12;
          //  if($Am_or_PM=='AM')$Am_or_PM='PM';
         //   else  if($Am_or_PM=='PM')$Am_or_PM='AM';
            return [$adjhours,$Am_or_PM];
        }
        if($adjhours<1) {
            $adjhours=$adjhours+12 ;
            if($Am_or_PM=='AM')$Am_or_PM='PM';
            else if($Am_or_PM=='PM')$Am_or_PM='AM';
        }
        return [$adjhours,$Am_or_PM];
    }
    public function getStartingSlotsBetween2Hours($current_working_hours_start,$current_working_hours_start_am_or_pm,$current_working_hours_end,$current_working_hours_end_am_or_pm)
    {

        if($current_working_hours_start_am_or_pm==$current_working_hours_end_am_or_pm)
            {
                $current_working_hours_max   =   $current_working_hours_start ;
                $current_working_hours_min   =   $current_working_hours_end;
                if($current_working_hours_end>$current_working_hours_start)
                {
                    $current_working_hours_min= $current_working_hours_start ;
                    $current_working_hours_max=   $current_working_hours_end;

                }


                $number_slots=$current_working_hours_max-$current_working_hours_min;
                   $slots = array($number_slots );
                $j=0;
                for  ($i=0;$i<$number_slots;$i++)
                {
                    $slots[$j++] = array($current_working_hours_min+$i , $current_working_hours_start_am_or_pm ,"exactly" , false);
                    $slots[$j++] = array($current_working_hours_min+$i , $current_working_hours_start_am_or_pm ,"and 15 min" , false);
                    $slots[$j++] = array($current_working_hours_min+$i , $current_working_hours_start_am_or_pm ,"and 30 min" , false);
                    $slots[$j++] = array($current_working_hours_min+$i , $current_working_hours_start_am_or_pm ,"and 45 min" , false);

                }

                return $slots;
            }
        else  if(
                    $current_working_hours_start_am_or_pm=='AM'
                    &&
                    $current_working_hours_end_am_or_pm=='PM'
                    &&
                    $current_working_hours_end==12

        )
        {
            $number_AM_slots=(12-$current_working_hours_start)  ;
            $slots = array( );
            $j=0;
            for  ($i=0;$i<$number_AM_slots;$i++)
            {
                $slots[$j++] = array($current_working_hours_start+$i,'AM' ,"exactly" , false);
                $slots[$j++] = array($current_working_hours_start+$i,'AM',"and 15 min" , false);
                $slots[$j++] = array($current_working_hours_start+$i,'AM',"and 30 min" , false);
                $slots[$j++] = array($current_working_hours_start+$i,'AM',"and 45 min" , false);
            }


            return $slots;

        }
        else  if($current_working_hours_start_am_or_pm=='AM' )
            {
                $number_AM_slots=(12-$current_working_hours_start)  ;
                $slots = array( );
                $j=0;
                for  ($i=0;$i<$number_AM_slots;$i++)
                {
                    $slots[$j++] = array($current_working_hours_start+$i,'AM' ,"exactly" , false);
                    $slots[$j++] = array($current_working_hours_start+$i,'AM',"and 15 min" , false);
                    $slots[$j++] = array($current_working_hours_start+$i,'AM',"and 30 min" , false);
                    $slots[$j++] = array($current_working_hours_start+$i,'AM',"and 45 min" , false);
                }

                $slots[$j++] = array(12,'PM' ,"exactly" , false );

                $slots[$j++] = array(12,'PM',"and 15 min" , false );

                $slots[$j++] = array(12,'PM',"and 30 min" , false );

                $slots[$j++] = array(12,'PM',"and 45 min" , false );

                $number_PM_slots=  $current_working_hours_end;

                for  ($i=1;$i<$number_PM_slots;$i++)
                {
                    $slots[$j++] = array($i,'PM',"exactly" , false );

                    $slots[$j++] = array($i,'PM',"and 15 min" , false );

                    $slots[$j++] = array($i,'PM',"and 30 min" , false );

                    $slots[$j++ ] = array($i,'PM',"and 45 min" , false );

                }
                return $slots;
            }
        else  if($current_working_hours_start_am_or_pm=='PM'  )
        {
            $number_PM_slots=(13-$current_working_hours_start);
            $slots = array( );
            $j=0;
            for  ($i=0;$i<$number_PM_slots-1;$i++)
            {
                $slots[ $j++] = array($current_working_hours_start+$i,'PM',"exactly" , false);
                $slots[$j++] = array($current_working_hours_start+$i,'PM',"and 15 min" , false);
                $slots[$j++] = array($current_working_hours_start+$i,'PM',"and 30 min" , false );
                $slots[$j++] = array($current_working_hours_start+$i,'PM',"and 45 min" , false );
            }
            $number_AM_slots=$current_working_hours_end;
            $slots[$j++] = array(12,'AM',"exactly" , false);
            $slots[$j++] = array(12,'AM',"and 15 min" , false);
            $slots[$j++] = array(12,'AM',"and 30 min" , false );
            $slots[$j++] = array(12,'AM',"and 45 min" , false );
            for  ($i=1;$i <$number_AM_slots;$i++)
            {
                $slots[$j++] = array($i,'AM',"exactly" , false);
                $slots[$j++] = array($i,'AM',"and 15 min" , false);
                $slots[$j++] = array($i,'AM',"and 30 min" , false );
                $slots[$j++] = array($i,'AM',"and 45 min" , false );
            }
            return $slots;
        }

    }
}
