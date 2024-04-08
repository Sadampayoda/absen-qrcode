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
                            <th scope="col">Ruangan</th>
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
                                <td>{{ $item->ruangan }}</td>
                                <td>
                                    <a href="{{route('ruang.show',['ruang' => $item->ruangan])}}" class="btn btn-outline-secondary">Show</a>
                                    <a href="{{route('ruang.edit',['ruang' => $item->ruangan])}}" class="btn btn-outline-secondary">Edit</a>
                                    <form action="{{ route('ruang.destroy', ['ruang' => $item->ruangan]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-secondary" value="ruangan" name="type" type="submit" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
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