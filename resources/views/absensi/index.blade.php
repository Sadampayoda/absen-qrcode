@extends('component.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col">
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
        <div class="row">
            <div class="col">
                <div class="card p-4">
                    <div class="row">
                        <div class="col-md-8">
                            <video id="video" autoplay></video>
                            <div class="d-grid">
                                <button class="btn btn-dark" id="capture">Ambil Gambar</button>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <form action="{{ route('absen.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="image" id="image">
                                <input type="hidden" name="id_ambil" value="{{ $data->id_ambil }}">
                                <div class="mb-2">
                                    <canvas id="canvas" class="border" width="320" height="250"></canvas>
                                </div>
                                <div class="mb-2">
                                    <label for="matkul">Mata Kuliah</label>
                                    <input class="form-control" type="text" id="matkul" disabled name="matkul"
                                        value="{{ $data->nama }}">
                                </div>
                                <div class="mb-2">
                                    <label for="matkul">Kelas</label>
                                    <input class="form-control" type="text" id="matkul" disabled name="matkul"
                                        value="{{ $data->kelas }}">
                                </div>
                                <div class="mb-2">
                                    <label for="matkul">Mulai Kuliah</label>
                                    <input class="form-control" type="text" id="matkul" disabled name="matkul"
                                        value="{{ $data->jam_mulai }}">
                                </div>
                                <div class="mb-2 mt-3 text-center">
                                    <h5 class="">Silahkan absen dengan jujur!!</h5>
                                    <p>Diharapkan ketika foto terlihat wajah dan latar belakang. <span
                                            class="text-danger">Jika
                                            melanggar maka akan diberikan sanksi!!!</span></p>
                                </div>
                                <div class="mb-2">
                                    <div class="d-grid">
                                        <button class="btn btn-dark">Absen sekarang</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const captureButton = document.getElementById('capture');

            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(stream => {
                    video.srcObject = stream;
                })
                .catch(error => {
                    console.error('Error accessing media devices:', error);
                });

            captureButton.addEventListener('click', () => {
                const context = canvas.getContext('2d');



                context.drawImage(video, 0, 0, canvas.width, canvas.height);


                const imageData = canvas.toDataURL('image/jpeg');


                document.getElementById('image').value = imageData;

            });
        });
    </script>
@endsection
