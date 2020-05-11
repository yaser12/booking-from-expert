<?php

namespace App\Http\Controllers\Auth;

use App\Model\StartOfSlot;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'expert' => ['required', 'string', 'min:2' ],
            'current_working_hours_start' => ['required',  'numeric'  ],
            'current_working_hours_end' => [ 'required', 'numeric' ],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create( array $data)
    {
        try{
            return     DB::transaction(function () use ($data)
            {
        $ip =   $data['user_ip'] ;//   if your ip = 127.0.0.1 get ip from http://ipecho.net/plain by  js
        $url='http://ip-api.com/json/' . $ip;
        $ipInfo = file_get_contents($url);
        echo "$ipInfo";
        $ipInfo = json_decode($ipInfo);
        $current_timezone = $ipInfo->timezone;




        $dtz =    new \DateTimeZone($current_timezone);
        $time_in_sofia = new  \DateTime('now', $dtz);

        $offset = $dtz->getOffset( $time_in_sofia ) / 3600; // use it to convert ot GMT
           $offset=2;
        $current_working_hours_start=$data['current_working_hours_start']; // time in User timezone

        $current_working_hours_end  =$data['current_working_hours_end'];// time in User timezone

        $current_end_time_in_12  = $this->adjustHours($current_working_hours_end  ,$data['current_working_hours_end_am_or_pm'],$offset  );// convert expert user time to (GMT) time
        $current_start_time_in_12= $this->adjustHours($current_working_hours_start,$data['current_working_hours_start_am_or_pm'],$offset);// convert expert user time to (GMT) time

        if($data['expert'])
        {
             $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
          ]);
            $user['expert']  = $data['expert'];
            $user['current_timezone']  = $current_timezone;
            $user['current_working_hours_start']  = $current_start_time_in_12[0]; // save time  in GMT time not in user local time
            $user['current_working_hours_end' ] =$current_end_time_in_12[0];    // save time in GMT  time not in user local time
            $user['current_working_hours_end_am_or_pm' ] = $current_end_time_in_12[1]  ;
            $user['current_working_hours_start_am_or_pm' ] = $current_start_time_in_12[1];   ;
            $user['county' ] =  $data['county'];   ;
            $user->save();
            $slots=$this->getStartingSlotsBetween2Hours( $user['current_working_hours_start'], $user['current_working_hours_start_am_or_pm' ],$user['current_working_hours_end' ],   $user['current_working_hours_end_am_or_pm' ]);

            // auto generate start of slots to be selected

            for($i=0;$i<count($slots);$i++)
            {
                $startOfSlot=new StartOfSlot();
                $startOfSlot['current_working_hours_start']=$slots[$i][0];

                $startOfSlot['current_working_hours_start_am_or_pm']=$slots[$i][1];

                $startOfSlot['current_working_hours_in_minutes_start']=$slots[$i][2];
                $startOfSlot['is_available']=$slots[$i][3];
                $startOfSlot['user_id']=$user->id;
                $startOfSlot->save();

            }

            return $user;

        }
        else{

        }
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
            });
        } catch (\Exception $e) {
            DB::rollback();
            return "error";
        }
    }
}
