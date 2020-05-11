\@extends('layouts.app')
@section('content')


    <h3 class="text-center mt-5">book a slot</h3>

    <div class="container">
            <div class="row justify-content-center alert-info">
                <div class="col-6">
                    <div class="card">
                        <div class="form-group row">
                            <div class="col-md-6">

                                {{request}}
                            <br>
                            {{$expert->expert }}
                            {{$expert->county }}
                            <br>
                            working hours: <label id="current_working_hours_start">{{$expert->current_working_hours_start }}</label><label id='current_working_hours_start_am_or_pm' >{{$expert->current_working_hours_end_am_or_pm }}</label> ->
                           <label id="current_working_hours_end">{{$expert->current_working_hours_end }}</label><label id='current_working_hours_end_am_or_pm'>{{$expert->current_working_hours_start_am_or_pm }}</label>
                        </div>
                        </div>
                            <br>

                             <br>
                        <div class="form-group row">
                            <div class="col-md-6">
                            choose duration :
                            <select id="durations" onchange="show_eqalvalent_slote();">
                                <option value="-1"   >choose duration</option>
                                <option value="1"   >15 min</option>
                                <option value="2">30 min</option>
                                <option value="3">45 min</option>
                                <option value="4">1 Hours</option>
                            </select>
                            </div>
                        </div>
                            <br>
                        <div class="form-group row">
                            <div >
                            choose slot starting time from :
                            <select style="display: none"  id="openning_slots_with_full" onchange="setToLabel(this)">
                                <option value="-1"   >choose slot starting time</option>

                            </select>
                            <select style="display: none"   id="openning_slots_with_remove_last_option" onchange="setToLabel(this)">
                                <option value="-1"   >choose slot starting time</option>

                            </select>
                            <select style="display: none"   id="openning_slots_with_remove_last_two_option" onchange="setToLabel(this)">
                                <option value="-1"   >choose slot starting time</option>

                            </select>
                            <select style="display: none"   id="openning_slots_with_remove_last_three_option" onchange="setToLabel(this)">
                                <option value="-1"   >choose slot starting time</option>

                            </select>.  to .
                            <span id="to">   </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            </div>

                        </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                </div>



                            </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                            <button id="booknow"  >book now</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script>
    fillselects();
    function booknow()
    {
        document.getElementById('booknow').disabled=true;

    }
    var current_working_hours_start=document.getElementById('current_working_hours_start').innerHTML;
    var current_working_hours_start_am_or_pm=document.getElementById('current_working_hours_start_am_or_pm').innerHTML;
    var resuleStart=convertGMTHour2UserTImeZone( current_working_hours_start,current_working_hours_start_am_or_pm);
    document.getElementById('current_working_hours_start').innerHTML=resuleStart[0];
    document.getElementById('current_working_hours_start_am_or_pm').innerHTML=resuleStart[1];
    var current_working_hours_end= document.getElementById('current_working_hours_end').innerHTML;
    var current_working_hours_end_am_or_pm=document.getElementById('current_working_hours_end_am_or_pm').innerHTML;
    var resultEnd=convertGMTHour2UserTImeZone(current_working_hours_end,current_working_hours_end_am_or_pm);
    document.getElementById('current_working_hours_end').innerHTML=resultEnd[0];
    document.getElementById('current_working_hours_end_am_or_pm').innerHTML=resultEnd[1];
</script>
@endsection
