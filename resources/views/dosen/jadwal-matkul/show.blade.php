@extends('component.app')

@section('content')

<div class="container mt-4">
    <!-- Tabel Responsif -->
    @if (session()->has('success'))
        @include('component.alert',[
            'message' => session('success'),
            'status' => 'success'
        ])
    @endif
    <div class="row">
        <div class="col">
            <h1>Ruangan {{$data->ruangan}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Ruangan :</th>
                            <td scope="col">{{$data->ruangan}}</td>
                            
                        </tr>
                        <tr>
                            <th scope="col">Hari Mata kuliah : </th>
                            <td scope="col">{{$data->hari}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Jam mulai Mata kuliah : </th>
                            <td scope="col">{{$data->jam_mulai}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Jam akhir Mata kuliah : </th>
                            <td scope="col">{{$data->jam_akhir}}</td>
                        </tr>
                    </thead>
                    
                </table>
                
            </div>
        </div>
    </div>
</div>
@endsection