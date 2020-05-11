@extends('layouts.app')
@section('content')
    <h3 class="text-center mt-5">choose Expert</h3>
    <?php
   // dd($users)
    ?>
    <div class="container">
        <div class="row justify-content-center alert-info">
            @foreach ($experts as $expert)
            <div class="col-6">
                <div class="card">
                       <div class="form-group row">

                                <label>{{$expert['name']}}</label>
                                <label>{{$expert['expert']}}</label>
                                <a href="moreinfo/{{$expert['id']}}" ><label>More info</label></a>

                       </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
@endsection
