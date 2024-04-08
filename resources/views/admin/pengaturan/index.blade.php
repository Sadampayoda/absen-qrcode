@extends('component.app')

@section('content')
    <div class="container mt-4">

        <div class="row d-flex justify-content-center">
            <div class="col-8 border-bottom p-3">
                <h2 class="text-center">Pengaturan periode</h2>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-3 mb-4">
            <div class="col-8">
                @if (session()->has('success'))
                    @include('component.alert', [
                        'message' => session('success'),
                        'status' => 'success',
                    ])
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>


        <div class="row d-flex justify-content-center mt-4">
            <div class="col-8">
                @if ($data)
                    <form action="{{ route('pengaturan.update', ['pengaturan' => $data->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="krs_mulai">Periode Krs Mulai</label>
                                <input type="date" value="{{ $data->krs_mulai }}" id="krs_mulai" name="krs_mulai"
                                    class="form-control">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="krs_akhir">Periode Krs Akhir</label>
                                <input type="date" value="{{ $data->krs_akhir }}" id="krs_akhir" name="krs_akhir"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="khs_mulai">Periode Khs Mulai</label>
                                <input type="date" value="{{ $data->khs_mulai }}" id="khs_mulai" name="khs_mulai"
                                    class="form-control">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="khs_akhir">Periode Khs Akhir</label>
                                <input type="date" value="{{ $data->khs_akhir }}" id="khs_akhir" name="khs_akhir"
                                    class="form-control">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark">Edit Periode</button>
                            </div>
                        </div>
                    </form>
                @else
                    <form action="{{ route('pengaturan.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="krs_mulai">Periode Krs Mulai</label>
                                <input type="date" id="krs_mulai" name="krs_mulai" class="form-control">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="krs_akhir">Periode Krs Akhir</label>
                                <input type="date" id="krs_akhir" name="krs_akhir" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="khs_mulai">Periode Khs Mulai</label>
                                <input type="date" id="khs_mulai" name="khs_mulai" class="form-control">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="khs_akhir">Periode Khs Akhir</label>
                                <input type="date" id="khs_akhir" name="khs_akhir" class="form-control">
                            </div>
                            <div class="d-grid ">
                                <button type="submit" class="btn btn-dark">Buat Periode</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
