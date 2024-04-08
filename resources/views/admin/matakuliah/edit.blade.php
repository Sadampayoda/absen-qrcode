@extends('component.app')

@section('content')
{{-- @dd($mata_kuliah) --}}
    <div class="container mt-4">
        <h2>Edit Data Mata Kuliah</h2>
        @if (session()->has('error'))
            @include('component.alert', [
                'message' => session('error'),
                'status' => 'error',
            ])
        @endif
        <form method="POST" action="{{ route('mata-kuliah.update',['mata_kuliah' => $mata_kuliah->id]) }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{$mata_kuliah->id}}">
            <div class="form-group">
                <label for="nama">Nama Mata Kuliah</label>
                <input type="text" id="nama" name="nama" class="form-control" value="{{ $mata_kuliah->nama }}">
                @error('nama')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="kelas">Kelas</label>
                <select class="form-control" id="kelas" name="kelas">
                    <option value="A" {{ $mata_kuliah->kelas == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ $mata_kuliah->kelas == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ $mata_kuliah->kelas == 'C' ? 'selected' : '' }}>C</option>
                    <option value="D" {{ $mata_kuliah->kelas == 'D' ? 'selected' : '' }}>D</option>
                    <option value="E" {{ $mata_kuliah->kelas == 'E' ? 'selected' : '' }}>E</option>
                </select>
                @error('kelas')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="sks">SKS</label>
                <select class="form-control" id="sks" name="sks">
                    <option value="2" {{ $mata_kuliah->sks == '2' ? 'selected' : '' }}>2</option>
                    <option value="3" {{ $mata_kuliah->sks == '3' ? 'selected' : '' }}>3</option>
                    <option value="4" {{ $mata_kuliah->sks == '4' ? 'selected' : '' }}>4</option>
                    <option value="6" {{ $mata_kuliah->sks == '6' ? 'selected' : '' }}>6</option>
                </select>
                @error('sks')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="semester">Semester</label>
                <select class="form-control" id="semester" name="semester">
                    @for ($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" {{ $mata_kuliah->semester == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                @error('semester')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="prasyarat">ID Mata Kuliah Prasyarat</label>
                <input type="text" id="prasyarat" name="prasyarat" class="form-control" value="{{ $mata_kuliah->prasyarat }}">
                @error('prasyarat')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="prasyarat_sks">SKS Mata Kuliah Prasyarat</label>
                <input type="text" id="prasyarat_sks" name="prasyarat_sks" class="form-control" value="{{ $mata_kuliah->prasyarat_sks }}">
                @error('prasyarat_sks')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="id_users">Dosen Mengajar</label>
                <select class="form-control" name="id_users" id="id_users">
                    <option selected disabled>Pilih Dosen</option>
                    @foreach ($data as $item)
                        <option value="{{ $item->id }}" {{ $mata_kuliah->id_users == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('id_users')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection
