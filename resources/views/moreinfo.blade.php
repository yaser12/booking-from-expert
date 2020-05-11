\@extends('layouts.app')
@section('content')
    <h3 class="text-center mt-5">choose Expert</h3>

    <div class="container">
            <div class="row justify-content-center alert-info">
                <div class="col-6">
                    <div class="card">
                        <label class="form-group row">
                                {{$expert->name }}
                            <br>
                            {{$expert->expert }}
                            {{$expert->county }}
                            <br>
                            working hours: <label id="current_working_hours_start">{{$expert->current_working_hours_start }}</label><label id='current_working_hours_start_am_or_pm' >{{$expert->current_working_hours_start_am_or_pm }}</label> ->
                           <label id="current_working_hours_end">{{$expert->current_working_hours_end }}</label><label id='current_working_hours_end_am_or_pm'>{{$expert->current_working_hours_end_am_or_pm  }}</label>

                            <br>
                            <a href="/book/{{$expert->id }}"><label>Book Now</label></a>
                            <br>
                            <br>
                            <script type = "text/javascript">

                                  function addHours(hours,Am_or_PM,numberHourstoAdd)
                                {   // 9 pm +7 = 4 AM
                                    // 9 Am +7 = 4PM
                                    //12 pm +1=1 PM
                          // alert(hours+ ' '+Am_or_PM+' add '+numberHourstoAdd);
                                    if(hours==12)
                                    {




                                        return [numberHourstoAdd,Am_or_PM];
                                    }
                                    sumhours=  hours+numberHourstoAdd;
                                    if(sumhours==12)
                                    {

                                       // if(Am_or_PM=='AM')Am_or_PM='PM';
                                        //else  if(Am_or_PM=='PM')Am_or_PM='AM';
                                        return [sumhours,Am_or_PM];
                                    }
                                     if(sumhours>12) {

                                        sumhours=sumhours-12 ;

                                          {
                                            if (Am_or_PM == 'AM') Am_or_PM = 'PM';
                                            else if (Am_or_PM == 'PM') Am_or_PM = 'AM';
                                        }
                                    }

                                    return [sumhours,Am_or_PM];
                                }
                                  function adjustHours(hours,Am_or_PM,numberHourstoadjust)
                                {
                                    // 2 pm -7 =  7 am
                                    //12 PM-1=11 AM
                                    //12 Am-1=11 PM
                                    if(hours==12)
                                    {
                                        if(Am_or_PM=='AM')Am_or_PM='PM';
                                        else if(Am_or_PM=='PM')Am_or_PM='AM';
                                        return [12-numberHourstoadjust,Am_or_PM];
                                    }
                                    adjhours=  hours-numberHourstoadjust;
                                    if(adjhours<1) {
                                        adjhours=adjhours+12 ;
                                        if(Am_or_PM=='AM')Am_or_PM='PM';
                                        else if(Am_or_PM=='PM')Am_or_PM='AM';
                                    }
                                    return [adjhours,Am_or_PM];
                                }
                                /*
                                function getTimezoneOffset() {
                                      function z(n){return (n<10? '0' : '') + n}
                                      var offset = new Date().getTimezoneOffset();
                                      var sign = offset < 0? '+' : '-';
                                      offset = Math.abs(offset);
                                      return sign + z(offset/60 | 0) + z(offset%60);
                                    }
                                 */
                                  function  convertGMTHour2UserTImeZone(GMTHour,AM_or_PM)
                                  {

                                      var dt = new Date();
                                      var tz = (dt.getTimezoneOffset() / 60)*-1;
                                      GMTHour=parseInt(GMTHour);
                                       var result= addHours(GMTHour,AM_or_PM,tz);



                                      return result;//[GMTHour,AM_or_PM]
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
                                <!-- current_timezone-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
