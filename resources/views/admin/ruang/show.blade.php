@extends('component.app')

@section('content')

<div class="container mt-4">
    <!-- Tabel Responsif -->
    @if (session()->has('success'))
        @include('component.alert',[
            'message' => session('success'),
            'status' => 'success'
        ])
    @endif
    <div class="row">
        <div class="col">
            <h1>Ruangan {{$data[0]->ruangan}}</h1>
        </div>
    </div>
    <div class="row mb-2">
        <form action="{{ route('ruang.create')}}" method="GET" style="display: inline;">
            <input type="hidden" name="id" value="{{$data[0]->ruangan}}">
            <button class="btn btn-outline-secondary" type="submit">Tambah Hari dan jam</button>
        </form>
    </div>
    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Jam Awal</th>
                            <th scope="col">Jam Akhir</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($data) --}}
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->hari }}</td>
                                <td>{{ $item->jam_mulai }}</td>
                                <td>{{ $item->jam_akhir }}</td>
                                <td>
                                    <form action="{{ route('ruang.destroy', ['ruang' => $item->id_ruang]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-secondary" type="submit" name="type" value="jam" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
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