<div class="row">
    <div class="col border-bottom text-center p-3">
        <h1>Masukan Password untuk Absensi</h1>

    </div>
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

<div class="row d-flex justify-content-center">

    @if ($data)
        <div class="col-9">
            <div class="card p-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-7">
                        <form
                            action="{{ route('dashboard.absensi', [
                                'id' => $data->id_ambil,
                                'token' => $data->token_absen,
                            ]) }}"
                            method="get">
                            <div class="mb-3 form-input">
                                <input class="form-control" type="text" id="name" value="{{ $data->name }}"
                                    disabled>
                                <p class="text-muted">Jika nama cocok maka submit</p>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="col-9">
            <div class="card p-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-7">
                        <div class="mb-3 form-input">

                            <input class="form-control" type="text" name="name" id="name"
                                value="Qr code tidak cocok dengan token" disabled>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-dark">Silahkan kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
