@extends('component.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Data Jam</h2>
    @if (session()->has('error'))
        @include('component.alert',[
            'message' => session('error'),
            'status' => 'error'
        ])
    @endif
    <form method="POST" action="{{route('ruang.update',['ruang' => $data])}}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="ruangan">Nama Ruangan</label>
            <input type="text" for="ruangan" name="ruangan" value="{{$data}}" class="form-control"> 
            @error('ruangan')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror   
        </div>

        <input type="hidden" name="name" value="{{$data}}">
        
        <button type="submit" class="btn btn-primary">Edit data</button>
    </form>
</div>
@endsection