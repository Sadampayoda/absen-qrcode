@extends('component.app')

@section('content')

    <div class="container mt-4">
        <h2>Jadwal Mata kuliah {{$name}}</h2>
        @if (session()->has('error'))
            @include('component.alert', [
                'message' => session('error'),
                'status' => 'error',
            ])
        @endif
        <form method="POST" action="{{ route('jadwal-matkul.store') }}">
            @csrf
            <input type="hidden" name="nama" value="{{$name}}">
            <div class="form-group">
                <label for="ruang">Tentukan Ruangan</label>
                <select class="form-control" name="ruang" id="ruang">
                    <option selected>Ruang tersisa</option>
                    <?php foreach ($data as $item): ?>
                    <option value="<?= $item ?>"><?= $item ?> 
                    </option>
                    <?php endforeach; ?>
                </select>
                @error('ruang')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="kelas">Tentukan kelas </label>
                <select class="form-control" name="kelas" id="kelas">
                    <option selected>Pilih Kelas</option>
                    <?php foreach ($kelas as $item): ?>
                    <option value="<?= $item ?>"><?= $item ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                @error('kelas')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Tambah data</button>
        </form>
    </div>
@endsection
