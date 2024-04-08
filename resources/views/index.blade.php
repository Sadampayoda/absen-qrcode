@extends('component.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col border-bottom p-4">
            <h1 class="text-center">Selamat datang di Website UPI</h1>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-9">
            <img src="{{asset('logo.png')}}" class=" text-center img-fluid" >
        </div>
    </div>
</div>
@endsection