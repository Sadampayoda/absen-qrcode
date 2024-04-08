@extends('component.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Data Jam</h2>
    @if (session()->has('error'))
        @include('component.alert',[
            'message' => session('error'),
            'status' => 'error'
        ])
    @endif
    <form method="POST" action="{{route('jam.store')}}">
        @csrf
        <div class="form-group">
            <label for="hari">Hari:</label>
            <select class="form-control" name="hari" id="hari">
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>>
            </select>
        </div>
        <div class="form-group">
            <label for="jamMulai">Jam Mulai:</label>
            <select class="form-control" name="jam" id="jam">
                <option value="07:00-09:00">Jam pertama | 07.00</option>
                <option value="09:00-11:00">Jam kedua | 09.00</option>
                <option value="11:00-12:30">Jam ketiga | 11.00</option>
                <option value="14:00-15:45">Jam keempat | 14.00</option>
                <option value="16:00-17:30">Jam kelima | 16.00</option>
                <option value="18:00-19:30">Jam keenam | 18.00</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tambah data</button>
    </form>
</div>
@endsection