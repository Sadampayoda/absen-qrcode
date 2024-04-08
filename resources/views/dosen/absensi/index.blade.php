@extends('component.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">

            <div class="input-group mb-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Foto Bukti</th>
                            <th scope="col">Tanggal absen</th>
                            <th scope="col">Waktu Absen</th>
                        </tr>
                    </thead>
                    <tbody id="user">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td><img src="{{asset('image/absen/'.$item->image)}}" class="img-fluid"></td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->waktu}}</td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination">
                    {{ $data->onEachSide(5)->links() }} 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
