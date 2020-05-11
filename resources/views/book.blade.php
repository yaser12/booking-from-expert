\@extends('layouts.app')
@section('content')
    <script>
        var user_startOfSlots_fullListArray=new Array();
        var user_startOfSlotslast_ListArray=new Array();
        var user_startOfSlotslast_threeArray=new Array();
        var user_startOfSlotslast_two_Array=new Array();
        var user_startOfSlotsArray=new Array();
        var current_user_startOfSlotsArray;
        function is_start_of_slot_id_in_appointments_array(appointment_in_same_date_for_current_expert,start_of_slot_id)
        {
            for(i=0;i<appointment_in_same_date_for_current_expert.length;i++)
            {
                if(appointment_in_same_date_for_current_expert[i].start_of_slot_id==start_of_slot_id)return true;
            }
            return false;
        }
        var appointment_must_be_removed_array=new Array();
        var option_remove_last_three_option;
        var option_remove_last_two_option;
        var option__remove_last_List ;
        function  fillselects(appointment_in_same_date_for_current_expert)
        {
            $('#openning_slots_with_full') // clear select befor fill it with correct appointment
                .find('option')
                .remove()
                .end()
                .append('<option value="-1"   >choose slot starting time</option>')
                .val('whatever')
            ;
            $('#openning_slots_with_remove_last_option')
                .find('option')
                .remove()
                .end()
                .append('<option value="-1"   >choose slot starting time</option>')
                .val('whatever')
            ;
            $('#openning_slots_with_remove_last_two_option')
                .find('option')
                .remove()
                .end()
                .append('<option value="-1"   >choose slot starting time</option>')
                .val('whatever')
            ;
            $('#openning_slots_with_remove_last_three_option')
                .find('option')
                .remove()
                .end()
                .append('<option value="-1"   >choose slot starting time</option>')
                .val('whatever')
            ;
            user_startOfSlotsArray=new Array({{count($user_startOfSlots)}} );
              user_startOfSlots_fullListArray=new Array();
              user_startOfSlotslast_ListArray=new Array();
              user_startOfSlotslast_threeArray=new Array();
              user_startOfSlotslast_two_Array=new Array();
            var start_slot_id=-1;
                <?php

                for ($i=0;$i<count($user_startOfSlots); $i++)
                {

                if($user_startOfSlots[$i]['is_available']==0)
                ?>
            var slots_by_user_time= convertGMTHour2UserTImeZone({{$user_startOfSlots[$i]['current_working_hours_start']}},'{{$user_startOfSlots[$i]['current_working_hours_start_am_or_pm']}}')
            user_startOfSlotsArray[{{$i}}]= new Array(5);
            user_startOfSlotsArray[{{$i}}][0]={{$user_startOfSlots[$i]['id']}};
            user_startOfSlotsArray[{{$i}}][1]=slots_by_user_time[0];
            user_startOfSlotsArray[{{$i}}][2]=slots_by_user_time[1];
            user_startOfSlotsArray[{{$i}}][3]='{{$user_startOfSlots[$i]['current_working_hours_in_minutes_start']}}';
            user_startOfSlotsArray[{{$i}}][4]='{{$user_startOfSlots[$i]['is_available']}}';
            <?php

            }
            ?>
         //   console.table(user_startOfSlotsArray);

            let option_fullList = document.getElementById('openning_slots_with_full').options;
            var i=0;
            appointment_must_be_removed_array=new Array();
            for(i=0;i<user_startOfSlotsArray.length ;i++)
            {
              if(    is_start_of_slot_id_in_appointments_array(appointment_in_same_date_for_current_expert,user_startOfSlotsArray[i][0])==true)
              {
                //  alert('block '+user_startOfSlotsArray[i] );
                //  this appointment is not avaliable in this day
                  try {
                      var j=0;
                      if (appointment_must_be_removed_array.indexOf(( user_startOfSlotsArray[i-j][1] + " " + user_startOfSlotsArray[i-j][2] + " " + user_startOfSlotsArray[i-j][3] )) === -1)
                          appointment_must_be_removed_array.push(user_startOfSlotsArray[i-j][1] + " " + user_startOfSlotsArray[i-j][2] + " " + user_startOfSlotsArray[i-j][3]);
                  }catch(e){
                      console.log(' error in  '+i-j +' ');
                  }
              }
               {
                  user_startOfSlots_fullListArray.push(user_startOfSlotsArray[i]);
                  option_fullList.add(
                      new Option(user_startOfSlotsArray[i][1]+" "+user_startOfSlotsArray[i][2]+" "+user_startOfSlotsArray[i][3], user_startOfSlotsArray[i][0])
                  );
              }


            }
            // remove current appointment  in this day  from  slot select
            for(i=0;i<appointment_must_be_removed_array.length;i++)
            {

                var y = document.getElementById('openning_slots_with_full');

                var val=appointment_must_be_removed_array[i];
                for (var k = 0; k< y.options.length; k++) {
                    if (y.options[k] .text == val) {
                        y[k] .   disabled = true ;
                    }
                }




            }
            option__remove_last_List = document.getElementById('openning_slots_with_remove_last_option').options;
            var i=0;
            appointment_must_be_removed_array=new Array();
            appointment_must_be_removed_array .push( user_startOfSlotsArray[user_startOfSlotsArray.length-1][1] + " " + user_startOfSlotsArray[user_startOfSlotsArray.length-1][2] + " " + user_startOfSlotsArray[user_startOfSlotsArray.length-1][3]);
            for(i=0;i<user_startOfSlotsArray.length ;i++)
            {
                if(    is_start_of_slot_id_in_appointments_array(appointment_in_same_date_for_current_expert,user_startOfSlotsArray[i][0])==true)
                {
                    //  this appointment is not avaliable in this day
                    // and must perviois 1 pre option blocks in this select
                    appointment_must_be_removed_array.push( user_startOfSlotsArray[i][1] + " " + user_startOfSlotsArray[i][2] + " " + user_startOfSlotsArray[i][3] );
                    for(j=1;j>=1;j--){
                        try {
                            if (appointment_must_be_removed_array.indexOf(( user_startOfSlotsArray[i-j][1] + " " + user_startOfSlotsArray[i-j][2] + " " + user_startOfSlotsArray[i-j][3] )) === -1)
                                appointment_must_be_removed_array.push(user_startOfSlotsArray[i-j][1] + " " + user_startOfSlotsArray[i-j][2] + " " + user_startOfSlotsArray[i-j][3]);
                        }catch(e){
                            console.log(' error in  '+i-j +' ');
                        }
                    }

                }
                  {
                    user_startOfSlotslast_ListArray.push(user_startOfSlotsArray[i]);
                    option__remove_last_List.add(
                        new Option(user_startOfSlotsArray[i][1] + " " + user_startOfSlotsArray[i][2] + " " + user_startOfSlotsArray[i][3], user_startOfSlotsArray[i][0])
                    );
                }
            }
            // remove current appointment  in this day  from  slot select
            for(i=0;i<appointment_must_be_removed_array.length;i++)
            {

                var y = document.getElementById('openning_slots_with_remove_last_option');

                var val=appointment_must_be_removed_array[i];
                for (var k = 0; k< y.options.length; k++) {
                    if (y.options[k] .text == val) {
                        y[k] .   disabled = true ;
                    }
                }




            }
            option_remove_last_two_option = document.getElementById('openning_slots_with_remove_last_two_option').options;
            var i=0;
              appointment_must_be_removed_array=new Array();
            appointment_must_be_removed_array .push( user_startOfSlotsArray[user_startOfSlotsArray.length-1][1] + " " + user_startOfSlotsArray[user_startOfSlotsArray.length-1][2] + " " + user_startOfSlotsArray[user_startOfSlotsArray.length-1][3]);
            appointment_must_be_removed_array .push( user_startOfSlotsArray[user_startOfSlotsArray.length-2][1] + " " + user_startOfSlotsArray[user_startOfSlotsArray.length-2][2] + " " + user_startOfSlotsArray[user_startOfSlotsArray.length-2][3]);

            for(i=0;i<user_startOfSlotsArray.length ;i++)
            {
                if(    is_start_of_slot_id_in_appointments_array(appointment_in_same_date_for_current_expert,user_startOfSlotsArray[i][0])==true)
                {
                    //  this appointment is not avaliable in this day
                    // and must perviois 2 pre option blocks in this select
                    appointment_must_be_removed_array.push( user_startOfSlotsArray[i][1] + " " + user_startOfSlotsArray[i][2] + " " + user_startOfSlotsArray[i][3] );
                    for(j=2;j>=1;j--){
                        try {
                            if (appointment_must_be_removed_array.indexOf(( user_startOfSlotsArray[i-j][1] + " " + user_startOfSlotsArray[i-j][2] + " " + user_startOfSlotsArray[i-j][3] )) === -1)
                                appointment_must_be_removed_array.push(user_startOfSlotsArray[i-j][1] + " " + user_startOfSlotsArray[i-j][2] + " " + user_startOfSlotsArray[i-j][3]);
                        }catch(e){
                            console.log(' error in  '+i-j +' ');
                        }
                    }

                }
                {
                    user_startOfSlotslast_two_Array.push(user_startOfSlotsArray[i]);
                option_remove_last_two_option.add(
                    new Option(user_startOfSlotsArray[i][1]+" "+user_startOfSlotsArray[i][2]+" "+user_startOfSlotsArray[i][3], user_startOfSlotsArray[i][0])
                );}
            }
            // remove current appointment  in this day  from  slot select
            for(i=0;i<appointment_must_be_removed_array.length;i++)
            {

                var y = document.getElementById('openning_slots_with_remove_last_two_option');

                var val=appointment_must_be_removed_array[i];
                for (var k = 0; k< y.options.length; k++) {
                    if (y.options[k] .text == val) {
                        y[k] .   disabled = true ;
                      //  y .remove(k);
                    }
                }




            }


            option_remove_last_three_option= document.getElementById('openning_slots_with_remove_last_three_option').options;
            var i=0;
              appointment_must_be_removed_array=new Array();
            appointment_must_be_removed_array .push( user_startOfSlotsArray[user_startOfSlotsArray.length-1][1] + " " + user_startOfSlotsArray[user_startOfSlotsArray.length-1][2] + " " + user_startOfSlotsArray[user_startOfSlotsArray.length-1][3]);
            appointment_must_be_removed_array .push( user_startOfSlotsArray[user_startOfSlotsArray.length-2][1] + " " + user_startOfSlotsArray[user_startOfSlotsArray.length-2][2] + " " + user_startOfSlotsArray[user_startOfSlotsArray.length-2][3]);
            appointment_must_be_removed_array .push( user_startOfSlotsArray[user_startOfSlotsArray.length-3][1] + " " + user_startOfSlotsArray[user_startOfSlotsArray.length-3][2] + " " + user_startOfSlotsArray[user_startOfSlotsArray.length-3][3]);

            for(i=0;i<user_startOfSlotsArray.length ;i++)
            {


                if(    is_start_of_slot_id_in_appointments_array(appointment_in_same_date_for_current_expert,user_startOfSlotsArray[i][0])==true)
                {
                    //  this appointment is not avaliable in this day
                    // and must perviois 3  pre option blocks in this select
                      appointment_must_be_removed_array.push( user_startOfSlotsArray[i][1] + " " + user_startOfSlotsArray[i][2] + " " + user_startOfSlotsArray[i][3] );
                    for(j=3;j>=1;j--){
                        try {
                         if (appointment_must_be_removed_array.indexOf(( user_startOfSlotsArray[i-j][1] + " " + user_startOfSlotsArray[i-j][2] + " " + user_startOfSlotsArray[i-j][3] )) === -1)
                                appointment_must_be_removed_array.push(user_startOfSlotsArray[i-j][1] + " " + user_startOfSlotsArray[i-j][2] + " " + user_startOfSlotsArray[i-j][3]);
                        }catch(e){
                            console.log(' error in  '+i-j +' ');
                        }
                    }
                }
                  {
                    user_startOfSlotslast_threeArray.push(user_startOfSlotsArray[i]);
                    option_remove_last_three_option.add(
                        new Option(user_startOfSlotsArray[i][1] + " " + user_startOfSlotsArray[i][2] + " " + user_startOfSlotsArray[i][3], user_startOfSlotsArray[i][0])
                    )
                };
            }
            // remove current appointment  in this day  from  slot select
            for(i=0;i<appointment_must_be_removed_array.length;i++)
            {

                    var y = document.getElementById('openning_slots_with_remove_last_three_option');

                    var val=appointment_must_be_removed_array[i];
                    for (var k = 0; k< y.options.length; k++) {
                        if (y.options[k] .text == val) {
                            y[k] .   disabled = true ;// y .remove(k);
                        }
                    }




            }

        }

        function  show_eqalvalent_slote() {


            if(document.getElementById('durations').options[document.getElementById('durations').selectedIndex].value==1)
            {
                //
                current_user_startOfSlotsArray=user_startOfSlots_fullListArray;
                document.getElementById('openning_slots_with_full').style.display = '';
                document.getElementById('openning_slots_with_remove_last_option').style.display='none';
                document.getElementById('openning_slots_with_remove_last_two_option').style.display='none';
                document.getElementById('openning_slots_with_remove_last_three_option').style.display='none';
            }
            if(document.getElementById('durations').options[document.getElementById('durations').selectedIndex].value==2)
            {
                current_user_startOfSlotsArray=user_startOfSlotslast_ListArray;
                    document.getElementById('openning_slots_with_remove_last_option').style.display='';
                document.getElementById('openning_slots_with_full').style.display='none';
                document.getElementById('openning_slots_with_remove_last_two_option').style.display='none';
                document.getElementById('openning_slots_with_remove_last_three_option').style.display='none';
            }
            if(document.getElementById('durations').options[document.getElementById('durations').selectedIndex].value==3)
            {
                current_user_startOfSlotsArray=user_startOfSlotslast_two_Array;
                document.getElementById('openning_slots_with_remove_last_two_option').style.display='';
                document.getElementById('openning_slots_with_remove_last_option').style.display='none';
                document.getElementById('openning_slots_with_full').style.display='none';
                document.getElementById('openning_slots_with_remove_last_three_option').style.display='none';
            }

            if(document.getElementById('durations').options[document.getElementById('durations').selectedIndex].value==4)
            {
                current_user_startOfSlotsArray=user_startOfSlotslast_threeArray;
                document.getElementById('openning_slots_with_remove_last_three_option').style.display='';
                document.getElementById('openning_slots_with_remove_last_option').style.display='none';
                document.getElementById('openning_slots_with_remove_last_two_option').style.display='none';
                document.getElementById('openning_slots_with_full').style.display='none';
            }

        }
var from_slot;
        function setToLabel(select)
        {

            var duration= parseInt(document.getElementById('durations').options[document.getElementById('durations').selectedIndex].value);
          // alert('duration = '+duration);
              from_slot=parseInt(select.selectedIndex)-1; // -1 to remover first option
            // alert(from_slot +',  duration = '+duration);
          //   alert('from_slot'+from_slot+'from'+document.getElementById('openning_slots_with_full').options.length);
         //   alert(current_user_startOfSlotsArray[from_slot]) ;
            var hourtoadd=0;
          //  alert('current_user_startOfSlotsArray '+( parseInt(current_user_startOfSlotsArray.length)-1) )
            if(from_slot==( parseInt(current_user_startOfSlotsArray.length)-1) )
            {
                var to_slot = resultEnd [0]+' '+resultEnd[1];// end time in working our

            }
            else
            if(from_slot==( parseInt(current_user_startOfSlotsArray.length)-3) && duration==3  )
            {
                var to_slot = resultEnd [0]+' '+resultEnd[1];// end time in working our

            }
            else
            if(from_slot==( parseInt(current_user_startOfSlotsArray.length)-2) && duration==2 )
            {
                var to_slot = resultEnd [0]+' '+resultEnd[1];// end time in working our

            }
            else
            if(from_slot==( parseInt(current_user_startOfSlotsArray.length)-1) && duration==1 )
            {
                var to_slot = resultEnd [0]+' '+resultEnd[1];// end time in working our

            }else if(duration==4)
            {
                hourtoadd=1;
                to_slotTime=addHours(current_user_startOfSlotsArray[from_slot][1],current_user_startOfSlotsArray[from_slot][2],hourtoadd) ;
                var to_slot = to_slotTime[0] + ' ' + to_slotTime[1] + ' ' + current_user_startOfSlotsArray[from_slot ][3]; // -1 to remover first option

            }
            else if(duration!=4) {
                hourtoadd=0;
                to_slotTime=addHours(current_user_startOfSlotsArray[from_slot][1],current_user_startOfSlotsArray[from_slot][2],hourtoadd) ;
                var to_slot = to_slotTime[0] + ' ' + to_slotTime[1] + ' ' + current_user_startOfSlotsArray[from_slot +duration][3]; // -1 to remover first option

            }

            start_slot_id=from_slot;
            //alert(current_user_startOfSlotsArray[from_slot]);
            document.getElementById('duration_slot').innerHTML=   'Your appointment will be on <br /> '+document.getElementById( 'slotdate' ).value+  ' <br /> from ' + current_user_startOfSlotsArray[from_slot][1]  +  ' ' + current_user_startOfSlotsArray[from_slot][2] +  ' ' + current_user_startOfSlotsArray[from_slot][3]+' to '+ to_slot;

        }

        function addHours(hours,Am_or_PM,numberHourstoAdd)
        {   // 9 pm +7 = 4 AM
            // 9 Am +7 = 4PM
            //12 pm +1=1 PM
//alert(hours+Am_or_PM+ " + "+ numberHourstoAdd);
            if(hours==12)
            {
                if(Am_or_PM=='AM')Am_or_PM='PM';
                else if(Am_or_PM=='PM')Am_or_PM='AM';


                return [numberHourstoAdd,Am_or_PM];
            }
            sumhours=  hours+numberHourstoAdd;
            if(sumhours==12)
            {
                if(Am_or_PM=='AM')Am_or_PM='PM';
                else  if(Am_or_PM=='PM')Am_or_PM='AM';
                return [sumhours,Am_or_PM];
            }
            if(sumhours>12) {
                sumhours=sumhours-12 ;
                {  if(Am_or_PM=='AM')Am_or_PM='PM';
                else  if(Am_or_PM=='PM')Am_or_PM='AM'; }
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


            GMTHour=GMTHour+tz;
            return result;//[GMTHour,AM_or_PM]
        }



    </script>

    <h3 class="text-center mt-5">book a slot</h3>

    <div class="container">
            <div class="row justify-content-center alert-info">
                <div class="col-6">
                    <div class="card">
                        <div class="form-group row">
                            <div class="col-md-6">

                                {{$expert->name }}
                                <br>
                                {{$expert->expert }}
                                {{$expert->county }}
                                <br>
                                working hours: <label id="current_working_hours_start">{{$expert->current_working_hours_start }}</label><label id='current_working_hours_start_am_or_pm' >{{$expert->current_working_hours_start_am_or_pm  }}</label> ->
                                <label id="current_working_hours_end">{{$expert->current_working_hours_end }}</label><label id='current_working_hours_end_am_or_pm'>{{$expert->current_working_hours_end_am_or_pm }}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <style>
                                    .input-container input {
                                        border: none;
                                        box-sizing: border-box;
                                        outline: 0;
                                        padding: .75rem;
                                        position: relative;
                                        width: 100%;
                                    }
                                    input[type="date"]::-webkit-calendar-picker-indicator {
                                        background: transparent;
                                        bottom: 0;
                                        color: transparent;
                                        cursor: pointer;
                                        height: auto;
                                        left: 0;
                                        position: absolute;
                                        right: 0;
                                        top: 0;
                                        width: auto;
                                    }
                                </style>
                                  <input type="date" id="slotdate"

                                         onchange=" get_appointment_in_date(); "   name="slotdate"  >
                                <button id="button_display_date">display date</button>
                                <script>
                                    var button = document.querySelector("#button_display_date");
                                    button.click();
                                    button.onclick = () => {
                                        var input = document.querySelector("#slotdate");
                                        input.focus()
                                        input.click()
                                    }
                                    function pad(d) {
                                        return (d < 10) ? '0' + d.toString() : d.toString();
                                    }
                                    var dateObj = new Date();
                                    var month = dateObj.getUTCMonth() + 1; //months from 1-12
                                    var day = dateObj.getUTCDate();
                                    var year = dateObj.getUTCFullYear();

                                    var datenow = year + "-" +pad(month)  + "-" + day;
                                  //  document.getElementById('slotdate').value=datenow;
                                </script>
                            </div>
                        </div>

                            <br>

                             <br>
                        <div class="form-group row">
                            <div class="col-md-6">
                            choose duration :
                            <select id="durations" onchange="show_eqalvalent_slote();" style="display: none">
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

                            </select>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <span id="duration_slot">   </span>
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
                            <button id="booknow"  onclick="booknow()">book now</button>
                                <span id="response"></span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script>

    function get_appointment_in_date()
    {
        var input = document.getElementById( 'slotdate' ).value;
        var d = new Date( input );
        if ( !!d.valueOf() ) { // Valid date
            year = d.getFullYear();
            month = d.getMonth();
            day = d.getDate();
        }else
        {
            alert('date must be valid date'); return;
        }
        $.ajax({
            url: '/get_appointments/{{$expert->id }}',
            dataType: 'json',
            type: 'get',
            contentType: 'application/json',
            data:  {

                 "year":  year
                , "month": parseInt( month) +1
                , "day":  day



                , "_token":"{{ csrf_token() }}"
            }   ,

            success: function( data, textStatus, jQxhr )
            {

                var appointment_in_same_date_for_current_expert =new Array(data.length);
                for(i=0;i<data.length;i++)
                {
                    appointment_in_same_date_for_current_expert[i]=data[i];
                }
               // console.table(appointment_in_same_date_for_current_expert);
              //  alert(appointment_in_same_date_for_current_expert.length);

                fillselects(appointment_in_same_date_for_current_expert);
                document.getElementById('durations').style.display='';

            },
            error: function( jqXhr, textStatus, errorThrown ){
                console.log( errorThrown );
            }
        });
    }

    function booknow()
    {
        var input = document.getElementById( 'slotdate' ).value;
        var d = new Date( input );
        if ( !!d.valueOf() ) { // Valid date
            year = d.getFullYear();
            month = d.getMonth();
            day = d.getDate();
        }else
    {
        alert('date must be valid date'); return;
    }
        document.getElementById('booknow').disabled=true;

       // alert( document.getElementById('durations').options[document.getElementById('durations').selectedIndex].value+ ' '+start_slot_id + ' '+ document.getElementById('duration_slot').innerHTML );
        $.ajax({
            url: '/booknow/{{$expert->id }}',
            dataType: 'json',
            type: 'get',
            contentType: 'application/json',
            data:  {
                                     "duration": document.getElementById('durations').options[document.getElementById('durations').selectedIndex].value
                                    , "year":  year
                                    , "month": parseInt( month)+1
                                    , "day":  day
                                    , "start_slot_id": current_user_startOfSlotsArray[   start_slot_id][0]
                                    , "duration_slot":  document.getElementById('duration_slot').innerHTML
                                    , "email":  document.getElementById('email').value
                                    , "name":  document.getElementById('name').value
                                    , "_token":"{{ csrf_token() }}"
                                    }   ,

            success: function( data, textStatus, jQxhr ){
                $('#response').html( JSON.stringify( data ) );
            },
            error: function( jqXhr, textStatus, errorThrown ){
                console.log( errorThrown );
            }
        });
    }

    var current_working_hours_start=document.getElementById('current_working_hours_start').innerHTML;
    var current_working_hours_start_am_or_pm=document.getElementById('current_working_hours_start_am_or_pm').innerHTML;
   // alert( 'befor convert'+current_working_hours_start +current_working_hours_start_am_or_pm  );
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
