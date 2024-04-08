@extends('component.app')

@section('content')
    <div class="container mt-4">
        <h2>Tambah Data Mata Kuliah</h2>
        @if (session()->has('error'))
            @include('component.alert', [
                'message' => session('error'),
                'status' => 'error',
            ])
        @endif
        <form method="POST" action="{{ route('mata-kuliah.store') }}">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Mata Kuliah</label>
                <input type="text" id="nama" name="nama" class="form-control">
                @error('nama')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="kelas">Kelas</label>
                <select class="form-control" id="kelas" name="kelas">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                </select>
                @error('kelas')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="sks">SKS</label>
                <select class="form-control" id="sks" name="sks">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="6">6</option>
                </select>
                @error('sks')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="semester">Semester</label>
                <select class="form-control" id="semester" name="semester">
                    @for ($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                @error('semester')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="prasyarat">ID Mata Kuliah Prasyarat</label>
                <input type="text" id="prasyarat" name="prasyarat" class="form-control">
                @error('prasyarat')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="prasyarat_sks">SKS Mata Kuliah Prasyarat</label>
                <input type="text" id="prasyarat_sks" name="prasyarat_sks" class="form-control">
                @error('prasyarat_sks')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="id_users">Dosen mengajar</label>
                <select class="form-control" name="id_users" id="id_users">
                    <option selected disabled>Pilih Dosen</option>
                    @foreach ($data as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} </option>
                    @endforeach
                </select>
                @error('id_users')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
    </div>
@endsection
