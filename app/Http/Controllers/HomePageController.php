<?php

namespace App\Http\Controllers;

use App\Model\Appointment;
use App\Model\StartOfSlot;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomePageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function welcome()
    {
        $users=User::whereNotNull('expert')

            ->get();

        $arr = Array('experts' => $users);
        return view('welcome', $arr);
    }
    public function moreinfo(Request $request,$id)
    {
        $user=User::where('id',$id)->first();

        $arr = Array('expert' => $user);
        return view('moreinfo', $arr);
    }
    public function book(Request $request,$id)
    {
        $user=User::where('id',$id)->first();
        $user_startOfSlots=StartOfSlot::Where('user_id',$id)->get();
        $arr = Array('expert' => $user,'user_startOfSlots'=>$user_startOfSlots);
        return view('book', $arr);
    }
    public function get_appointments(Request $request,$id)
    {

        $appointments=Appointment::where(
                                         [
                                            ['expert_id','=',$id]
                                            ,
                                            ['day','=',$request->day]
                                            ,
                                            ['month','=',$request->month]
                                            ,
                                            ['year','=',$request->year]
                                        ]
                                        )->get();
        return $appointments;
    }
    public function booknow(Request $request,$id)
    {
        try{
            return     DB::transaction(function () use ($request,$id)
            {
                $user=User::where('id',$id)->first();// expert user
                $duration=$request->duration;
                $start_slot_id=$request->start_slot_id;
                $duration_slot=$request->duration_slot;
                $name=$request->name;
                $email=$request->email;

                $guest=new User();
                $guest->email=$email;
                $guest->password=Hash::make('');
                $guest->name=$name;
                $guest->save();
                $user_startOfSlots=StartOfSlot::where([
                                                        ['user_id','=',$id]
                                                            ,
                                                        ['id','>=',$start_slot_id]
                                                        ]
                                                        )->take($duration)
                    ->get();
                $durationTemp=1;
                foreach ($user_startOfSlots as $start_of_slot)
                {
                        $appointment=new Appointment();
                        $appointment->appointment_date= Carbon::now('UTC')  ;
                        $appointment->year=$request->year;
                        $appointment->day=$request->day;
                        $appointment->month=$request->month;
                        $appointment->start_of_slot_id = $start_of_slot->id;

                        $appointment-> expert_id=$id;
                        $appointment-> user_id=$guest->id;
                        $appointment->save();
                       if( $durationTemp== $duration)break;
                    $durationTemp++;
                }
                $user = [
                    'name' => 'from expert '.$user->name,
                    'info' => $duration_slot
                ];

                \Mail::to( $guest->email)->send(new \App\Mail\NewBookingMail($user));

        $arr = Array('expert' => 'booked !'  );
        return $arr;
            });
        } catch (\Exception $e) {
            DB::rollback();
            return "error".$e;
        }
    }
public function test(){
    $current_end_time_in_12  = $this->adjustHours(1  ,'PM',2  );// convert expert user time to (GMT) time
    $current_start_time_in_12= $this->adjustHours(2,'PM',2);// convert expert user time to (GMT) time
    $t1  = $current_start_time_in_12[0]; // save time  in GMT time not in user local time
    $t11 =$current_end_time_in_12[0];    // save time in GMT  time not in user local time
    $t2 = $current_end_time_in_12[1]  ;
    $t22 = $current_start_time_in_12[1];   ;
    $arr = Array('test' => 'f');
    return view('test', $arr);
}
}
