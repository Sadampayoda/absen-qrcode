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
    @if (session()->has('error'))
        @include('component.alert',[
            'message' => session('error'),
            'status' => 'error'
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
                                <td>
                                    <a href="{{route('jadwal-matkul.show', ['jadwal_matkul' => $item->nama])}}" class="btn btn-outline-secondary">Show</a>
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