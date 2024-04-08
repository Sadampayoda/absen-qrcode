@extends('component.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <h1>Transkip Nilai</h1>
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
                <div class="input-group mb-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">SKS</th>
                                <th scope="col">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                                $total = 0;
                            @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    {{-- <td>{{ $item->id }}</td> --}}
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kelas }}</td>
                                    <td>{{ $item->sks }}</td>
                                    <td>{{ $item->nilai }}</td>
                                    {{-- <td>{{$item->id_ambil}}</td> --}}

                                </tr>
                                @php
                                    $total = $total + $item->sks;
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
                        <div class="col-6">
                            <label for="sks_total">SKS Total</label>
                            <input type="text" disabled class="form-control" name="sks_total" id="sks_total"
                                value="{{ $total }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
