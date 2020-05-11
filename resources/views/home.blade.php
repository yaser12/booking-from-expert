@extends('layouts.app')

@section('content')

  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">User Dashboard </div>
                  <div class="card-body">You are logged in!</div>
              </div>
              <div>
                  @foreach($appointments  as $appointment)
                      <li style="margin-top: 0px;"

                          class="">
                          <div class="uk-card card card_small-overlay card_collapse-xsmall">
                              <div
                                  class="card__label card__label_uppercase uk-text-right uk-visible@m">
                                    <span
                                                            class="uk-text-muted">{{$appointment->year }}-{{$appointment->month }}-{{$appointment->day }}</span>
                                  <span
                                      class="uk-text-muted">{{$appointment->user->name }}  {{$appointment->user->email }}  </span>
                                  <span
                                      class="uk-text-muted">

                                  </span>

                              </div>
                          </div>

                      </li>
                  @endforeach
              </div>
          </div>
      </div>
  </div>
  @endsection
