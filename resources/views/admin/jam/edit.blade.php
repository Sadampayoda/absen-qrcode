@extends('component.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Data Jam</h2>
    <form method="POST" action="{{ route('jam.update',['jam' => $jam->id]) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="hari">Hari:</label>
            <select class="form-control" name="hari" id="hari">
                <option value="Senin" {{ $jam->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                <option value="Selasa" {{ $jam->hari == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                <option value="Rabu" {{ $jam->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                <option value="Kamis" {{ $jam->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                <option value="Jumat" {{ $jam->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                <option value="Sabtu" {{ $jam->hari == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                <option value="Minggu" {{ $jam->hari == 'Minggu' ? 'selected' : '' }}>Minggu</option>
            </select>
        </div>
        <div class="form-group">
            <label for="jamMulai">Jam Mulai:</label>
            <select class="form-control" name="jam" id="jam">
                <option value="07:00-09:00" {{ $jam->jam == '07:00-09:00' ? 'selected' : '' }}>Jam pertama | 07.00</option>
                <option value="09:00-11:00" {{ $jam->jam == '09:00-11:00' ? 'selected' : '' }}>Jam kedua | 09.00</option>
                <option value="11:00-12:30" {{ $jam->jam == '11:00-12:30' ? 'selected' : '' }}>Jam ketiga | 11.00</option>
                <option value="14:00-15:45" {{ $jam->jam == '14:00-15:45' ? 'selected' : '' }}>Jam keempat | 14.00</option>
                <option value="16:00-17:30" {{ $jam->jam == '16:00-17:30' ? 'selected' : '' }}>Jam kelima | 16.00</option>
                <option value="18:00-19:30" {{ $jam->jam == '18:00-19:30' ? 'selected' : '' }}>Jam keenam | 18.00</option>
                <option value="20:00-21:30" {{ $jam->jam == '20:00-21:30' ? 'selected' : '' }}>Jam ketujuh | 20.00</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Data</button>
    </form>
</div>
@endsection
