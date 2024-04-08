@extends('component.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <h1>Penilaian Mata Kuliah {{$data[0]->nama}} {{$data[0]->kelas}}</h1>
        </div>
        <!-- Tabel Responsif -->
        @if (session()->has('success'))
            @include('component.alert', [
                'message' => session('success'),
                'status' => 'success',
            ])
        @endif
        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Mahasiwa</th>
                                <th scope="col">NIM</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->nim }}</td>
                                    <td>
                                        @if ($item->nilai != 'not')
                                            <button class="btn btn-success">{{$item->nilai}}</button>
                                            
                                        @else
                                            <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#nilaiModal{{ $item->id_ambil }}">Hasil Penilaian</button>
                                            
                                        @endif
                                    </td>
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach ($data as $item)
        <div class="modal fade" id="nilaiModal{{ $item->id_ambil }}" tabindex="-1" aria-labelledby="nilaiModalLabel{{ $item->id_ambil }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="nilaiModalLabel{{ $item->id_ambil }}">Input Nilai Mata Kuliah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk input nilai -->
                        <form action="{{ route('nilai.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" name="id_ambil_matkul" value="{{ $item->id_ambil }}" >
                                <label for="nilai" class="form-label">Pilih Nilai Mata Kuliah</label>
                                <select class="form-select" id="nilai" name="nilai" required>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
