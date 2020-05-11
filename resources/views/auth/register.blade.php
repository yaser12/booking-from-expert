@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                    <div class="card-header">{{ __('Register As Expert User') }}</div>

            <!-- we need use this  js script to get real ip  if our ip is 127.0.0.1 -->
                <script>

                    var  ip='';
                    $.get('http://ipecho.net/plain', function(data) {
                        ip=data;
                        $(".card-body").show();
                        $("#user_ip").val( ip);
                    })

                </script>
                <div class="card-body" style="display: block">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                    <?php
                        $url='http://ip-api.com/json/123.123.234.232'  ;
                        $ipInfo = file_get_contents($url);
                      //  echo "$ipInfo";
                        $ipInfo = json_decode($ipInfo);
                        $timezone = $ipInfo->timezone;



                        $dtz = new DateTimeZone($timezone);
                        $time_in_sofia = new DateTime('now', $dtz);
                      //  echo date("Y-m-d H:i:s")."<br>"; ;
                    //    echo "<br>".time()."UTC <br>"; // time in UTC
                        echo $dtz->getOffset( $time_in_sofia );
                        $offset = $dtz->getOffset( $time_in_sofia ) / 3600;
                        echo "GMT" . ($offset < 0 ? $offset : "+".$offset);
                        echo 6-$offset;
                        ?>

                        <div class="form-group row">
                            <input  type="hidden"   name="user_ip" id="user_ip"   required  >  <!-- we use user_ip hidden failed  if our ip is 127.0.0.1 -->
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }} </label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                            <div class="form-group row">
                                <label for="expert" class="col-md-4 col-form-label text-md-right">{{ __('Expert In : ') }}</label>

                                <div class="col-md-6">
                                    <input id="expert" type="expert" class="form-control{{ $errors->has('expert') ? ' is-invalid' : '' }}" name="expert" value="{{ old('expert') }}" required>

                                    @if ($errors->has('expert'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('expert') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        <div class="form-group row">
                            <label for="county" class="col-md-4 col-form-label text-md-right">{{ __('County : ') }}</label>

                            <div class="col-md-6">
                                <input id="county" type="county" class="form-control{{ $errors->has('county') ? ' is-invalid' : '' }}" name="county" value="{{ old('county') }}" required>

                                @if ($errors->has('county'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('county') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                            @if ($errors->has('current_timezone'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('current_timezone') }}</strong>
                            </span>
                            @endif

                            <div class="form-group row">
                                <label for="current_working_hours_start" class="col-md-4 col-form-label text-md-right">{{ __('current_working_hours_start ') }}</label>

                                <div class="col-md-1">
                                    AM
                                    <input id="current_working_hours_start_am_or_pm" value="AM" type="radio"   name="current_working_hours_start_am_or_pm" value="{{ old('current_working_hours_start_am_or_pm') }}"   checked >
                                </div>
                                <div class="col-md-1">PM
                                    <input id="current_working_hours_start_am_or_pm" value="PM" type="radio"   name="current_working_hours_start_am_or_pm" value="{{ old('current_working_hours_start_am_or_pm') }}"  >
                                </div>

                                <div class="col-md-4">

                                    <input id="current_working_hours_start" type="number" max="12" min="1" class="form-control{{ $errors->has('current_working_hours_start') ? ' is-invalid' : '' }}" name="current_working_hours_start" value="{{ old('current_working_hours_start') }}" required>

                                    @if ($errors->has('current_working_hours_start'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('current_working_hours_start') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="current_working_hours_end" class="col-md-4 col-form-label text-md-right">{{ __('current_working_hours_end ') }}</label>
                                <div class="col-md-1">
                                    AM
                                    <input id="current_working_hours_end_am_or_pm" type="radio"   value="AM"    name="current_working_hours_end_am_or_pm" value="{{ old('current_working_hours_end_am_or_pm') }}"  checked >
                                </div>
                                    <div class="col-md-1">
                                        PM
                                    <input id="current_working_hours_end_am_or_pm" type="radio"   value="PM"   name="current_working_hours_end_am_or_pm" value="{{ old('current_working_hours_end_am_or_pm') }}"  >
                                    </div>


                                <div class="col-md-4">

                                    <input id="current_working_hours_end" type="number" max="12" min="1" class="form-control{{ $errors->has('current_working_hours_end') ? ' is-invalid' : '' }}" name="current_working_hours_end" value="{{ old('current_working_hours_end') }}" required>

                                    @if ($errors->has('current_working_hours_end'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('current_working_hours_end') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
