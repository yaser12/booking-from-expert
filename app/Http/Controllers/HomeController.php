<?php

namespace App\Http\Controllers;

use App\Model\Appointment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $expert_id=$request->user()->id;
        $appointment=Appointment::where('expert_id',$expert_id)
            ->  with(array('user' => function ($query)  {

                 }))
            ->  with(array('start_of_slot' => function ($query)  {

            }))      ->
            get()    ;
             $arr = Array('appointments' =>  $appointment);
        return view('home',$arr);
    }


}
