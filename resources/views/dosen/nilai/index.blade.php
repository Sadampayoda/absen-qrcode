@extends('component.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <h1>Penilaian Mata kuliah</h1>
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
                @if ($status == 'aktif')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Mulai Khs!</strong> Masih dalam masa periode KHS untuk Dosen

                    </div>
                @else
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Berakhir Khs!</strong> masa periode KHS untuk Dosen telah berakhir

                    </div>
                @endif
            </div>
        </div>
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
                                        @if ($status == 'aktif')
                                            <a href="{{ route('nilai.show', ['nilai' => $item->id_jadwal]) }}"
                                                class="btn btn-outline-secondary">Nilai Mahasiswa</a>
                                        @else
                                            <p>Belum Periode KHS</p>
                                        @endif

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
