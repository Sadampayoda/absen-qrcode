@extends('component.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <h1>Users Manajement</h1>
        </div>
        <!-- Tabel Responsif -->
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
        <div class="row">
            <div class="col-6 mb-2">
                <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#createUserModal">
                    Tambah User Manajemen
                </button>
            </div>
            {{-- <div class="col-6 mb-2 ">

                <div class="form-inline float-right">
                    <input class="form-control mr-sm-2" type="search" id="search" placeholder="Search"
                        aria-label="Search">
                    <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
                </div>
            </div> --}}
        </div>
        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                {{-- <th scope="col">Foto</th> --}}
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">nim</th>
                                <th scope="col">Role</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="user">
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    {{-- <td><img src="{{ asset('image/users/' . $item->foto) }}" width="75" height="75">
                                    </td> --}}
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->nim }}</td>
                                    <td>{{ $item->level }}</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-secondary" data-toggle="modal"
                                            data-target="#editUserModal{{ $item->id }}">
                                            Edit
                                        </button>

                                        <form
                                            action="{{ route('user-manejement.destroy', ['user_manejement' => $item->id]) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-secondary" type="submit"
                                                onclick="return confirm('Anda yakin ingin menghapus data ini?')">Delete</button>
                                        </form>
                                    </td>
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



    <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">Tambah User Manajemen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user-manejement.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        {{-- <div class="form-group">
                            <label for="foto">Foto:</label>
                            <input type="file" class="form-control-file" id="foto" name="foto">
                        </div> --}}
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-control" id="nama" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="nim">Nim :</label>
                            <input type="nim" class="form-control" id="nim" name="nim" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password:</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" required>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="level">level:</label>
                            <select class="form-control" id="level" name="level" required>
                                <option selected>Pilih Jenis Role</option>
                                <option value="admin">Admin</option>
                                <option value="dosen">Dosen</option>
                                <option value="mahasiswa">Mahasiswa</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script> --}}



    @foreach ($data as $item)
        <div class="modal fade" id="editUserModal{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('user-manejement.update', ['user_manejement' => $item->id]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            {{-- <div class="form-group">
                                <input type="hidden" name="foto_lama" value="{{$item->foto}}">
                                <label for="foto">Foto:</label>
                                <input type="file" class="form-control-file" id="foto" name="foto">
                            </div> --}}
                            <div class="form-group">
                                <label for="nama">Nama:</label>
                                <input type="text" class="form-control" id="nama" name="name" value="{{ $item->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $item->email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="nim">Nim :</label>
                                <input type="nim" class="form-control" id="nim" name="nim" value="{{ $item->nim }}" required>
                            </div>
                    
                            
                            <div class="form-group">
                                <label for="level">level:</label>
                                <select class="form-control" id="level" name="level" required>
                                    <option value="admin" {{ $item->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="dosen" {{ $item->role === 'dosen' ? 'selected' : '' }}>dosen</option>
                                    <option value="mahasiswa" {{ $item->role === 'mahasiswa' ? 'selected' : '' }}>mahasiswa</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var searchInput = document.getElementById('search');

            searchInput.addEventListener('keyup', function() {
                var search = this.value;
                var xhr = new XMLHttpRequest();



                xhr.open('GET', "{{ route('search.user') }}?search=" + search, true);


                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            document.getElementById('user').innerHTML = xhr.responseText;
                        } else {
                            console.error('Terjadi kesalahan: ' + xhr.status);
                            alert('Terjadi kesalahan. Silakan coba lagi.');
                        }
                    }
                };
                xhr.send();
            });
        });
    </script>



@endsection
