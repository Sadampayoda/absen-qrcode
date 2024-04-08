@extends('component.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <h1>KRS</h1>
        </div>
        <!-- Tabel Responsif -->
        @if (session()->has('success'))
            @include('component.alert', [
                'message' => session('success'),
                'status' => 'success',
            ])
        @endif
        @if (session()->has('error'))
            @include('component.alert', [
                'message' => session('error'),
                'status' => 'error',
            ])
        @endif
        <div class="row">
            <div class="col">
                @if ($status == 'aktif')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Mulai Krs!</strong> Masih dalam masa periode KRS untuk Mahasiswa
                        
                    </div>
                @else
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Berakhir Krs!</strong> masa periode KRS untuk Mahasiswa telah berakhir
                        
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
                                <th scope="col">Nama</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">SKS</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                                $sks_total = 0;
                            @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    {{-- <td>{{ $item->id }}</td> --}}
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kelas }}</td>
                                    <td>{{ $item->sks }}</td>
                                    {{-- <td>{{$item->id_ambil}}</td> --}}
                                    <td>
                                        @if ($status == 'aktif')
                                            <form action="{{ route('krs.destroy', $item->id_ambil) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-secondary" type="submit"
                                                    onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
                                            </form>
                                            
                                        @else
                                            <a href="{{ route('krs.show', $item->id_ambil) }}"
                                                class="btn btn-outline-secondary">Absensi Qrcode</a>
                                            
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $sks_total = $sks_total + $item->sks;
                                    $i++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card p-3">
                    <div class="row">
                        <div class="col">
                            <label for="sks">SKS yang di peroleh</label>
                            <input type="text" disabled class="form-control" name="sks" id="sks"
                                value="{{ $sks->sks }}">
                        </div>
                        <div class="col">
                            <label for="sks_total">SKS Total</label>
                            <input type="text" disabled class="form-control" name="sks_total" id="sks_total"
                                value="{{ $sks_total }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
