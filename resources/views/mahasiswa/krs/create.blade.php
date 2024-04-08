@extends('component.app')

@section('content')
    <div class="container mt-4">
        <h2>Tambah Data Mata Kuliah</h2>
        @if (session()->has('error'))
            @include('component.alert', [
                'message' => session('error'),
                'status' => 'error',
            ])
        @endif
        <div class="form-group">
            <label for="matkul">Pilih Semester</label>
            <select class="form-control" id="matkul" name="matkul">
                <option selected>Pilih Semester</option>
                @foreach ($data as $item)
                    <option value="{{ $item->semester }}">{{ $item->semester }}</option>
                @endforeach
            </select>
        </div>
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
                                <th scope="col">Ruangan</th>
                                <th scope="col">Hari</th>
                                <th scope="col">Jam kuliah</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="ambil">

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>

    {{-- <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var matkul = document.getElementById('matkul');
            matkul.addEventListener('change', function() {
                var semester = this.value;
                var xhr = new XMLHttpRequest();
                // console.log(semester);
                xhr.open('GET', "{{ route('krs.select') }}" + "?semester=" + semester, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var data = xhr.responseText;
                            // console.log(data)
                            document.getElementById('ambil').innerHTML = data;
                        } else {
                            console.error('Terjadi kesalahan saat memuat data');
                        }
                    }
                };
                xhr.send();
            });
        });
    </script>
@endsection
