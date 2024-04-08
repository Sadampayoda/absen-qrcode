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
            <div class="input-group mb-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">SKS</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Prasyarat</th>
                            <th scope="col">Prasyarat Sks</th>
                            <th scope="col">Dosen Mengajar</th>
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
                                {{-- <td>{{ $item->id }}</td> --}}
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->kelas }}</td>
                                <td>{{ $item->sks }}</td>
                                <td>{{ $item->semester }}</td>
                                <td>{{ $item->prasyarat }}</td>
                                <td>{{ $item->prasyarat_sks }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                            
                                    <form action="{{ route('mata-kuliah.edit',['mata_kuliah'=> $item->id]) }}" method="GET" style="display: inline;">
                                        <button class="btn btn-outline-secondary" type="submit">Edit</button>
                                    </form>
                                    <form action="{{ route('mata-kuliah.destroy',['mata_kuliah'=> $item->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-secondary"   type="submit" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
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