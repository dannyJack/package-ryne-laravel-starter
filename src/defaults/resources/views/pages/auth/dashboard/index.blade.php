@extends('layouts.auth.app')
@section('bodyClass', 'pg-')
@section('contentHeader')
    @section('contentHeaderTitle')
        <i class="fas fa-heading"></i> {{ __('words.Title') }}
    @endsection
    <a href="{{-- route('page.action') --}}"><button class="btn btn-dark" >{{ __('words.Action') }}</button></a>
@endsection
@section('content')
    <div class="box">
        <div class="card card-container">
            <div class="card-body">
                Content
            </div>
        </div>
    </div>
@endsection