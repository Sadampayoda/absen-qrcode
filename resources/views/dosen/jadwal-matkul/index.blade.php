@extends('component.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <h1>Jadwal Mata kuliah</h1>
    </div>
    <!-- Tabel Responsif -->
    @if (session()->has('success'))
        @include('component.alert',[
            'message' => session('success'),
            'status' => 'success'
        ])
    @endif
    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Mata kuliah</th>
                            <th scope="col">Kelas </th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->kelas }}</td>
                                <td>
                                    <a href="{{route('jadwal-dosen.show', ['id' => $item->id_ruang])}}" class="btn btn-outline-secondary">Show jadwal</a>
                                    <a href="{{route('jadwal-dosen.siswa', ['id' => $item->id_jadwal])}}" class="btn btn-outline-secondary">Show Mahasiswa</a>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
@endsection