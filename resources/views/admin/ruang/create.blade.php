@extends('component.app')

@section('content')
    <div class="container mt-4">
        <h2>Tambah Data Jam</h2>
        @if (session()->has('error'))
            @include('component.alert', [
                'message' => session('error'),
                'status' => 'error',
            ])
        @endif
        <form method="POST" action="{{ route('ruang.store') }}">
            @csrf
            @if ($id)
                <input type="hidden" name="id" value="{{ $id }}">
            @else
                <div class="form-group">
                    <label for="ruangan">Nama Ruangan</label>
                    <input type="text" for="ruangan" name="ruangan" class="form-control">
                    @error('ruangan')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            @endif
            
            <div class="form-group">
                <label for="Jam">Tentukan hari dan jam</label>
                <select class="form-control" name="jam" id="jam">
                    <option selected>Pilih hari</option>
                    <?php foreach ($data as $item): ?>
                    <option value="<?= $item->id ?>"><?= $item->hari ?> | <?= $item->jam_mulai ?>-<?= $item->jam_akhir ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                @error('jam')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Tambah data</button>
        </form>
    </div>
@endsection
