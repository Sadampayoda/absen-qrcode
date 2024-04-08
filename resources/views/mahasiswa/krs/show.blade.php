@extends('component.app')

@section('content')
    <div class="container mt-4" id="absen">
        <div class="row">
            <h1>Absensi Mata Kuliah {{ $data->nama }}</h1>
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
                                <th scope="col">Qrcode</th>
                            </tr>
                        </thead>
                        {{-- {{auth()->user()->token_absen}} --}}
                        <tbody>
                            <tr>
                                <td>
                                    <div class="visible-print text-center">
                                        {!! QrCode::size(400)->generate($data->token_absen) !!}
                                        <p>Setiap Absen Qrcode akan berubah jadi tolong di foto</p>
                                    </div>
                                </td>
                            <tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <input type="hidden" name="result" id="result">
        <input type="hidden" name="id_ambil" id="id" value="{{ $data->id_ambil }}">
        <div class="row mt-5">
            <div class="col mt-5">
                <h4 class="text-center">Scan menggunakan Hp</h4>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-7 mt-3">
                <div id="reader" width="600px"></div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    {{-- <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script> --}}
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            var id = $("#id").val()


            $('#result').val(decodedText);
            let token_absen = decodedText;
            let url = '/' + token_absen + '/cek/' + id;
            // alert(token_absen)
            html5QrcodeScanner.clear().then(_ => {
                // alert(url)
                var xhr = new XMLHttpRequest();
                xhr.open('GET', url, true);

                // Set header jika diperlukan
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var responseData = xhr.responseText;


                            document.getElementById('absen').innerHTML = responseData;
                        } else {
                            console.log(xhr.responseText);
                            alert('Ada kesalahan dalam permintaan: ' + xhr.status);
                        }
                    }
                };

                xhr.send();

            }).catch(error => {
                alert('something wrong' + error);
            });

        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            // console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 350,
                    height: 350
                }
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
    
@endsection
