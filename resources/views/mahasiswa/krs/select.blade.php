@php
    $i = 1;
@endphp
@foreach ($data as $item)
    <tr>
        <td>{{ $i }}</td>
        {{-- <td>{{ $item->id }}</td> --}}
        <td>{{ $item->nama }}</td>
        <td>{{ $item->kelas }}</td>
        <td>{{ $item->sks }}</td>
        <td>{{ $item->ruangan }}</td>
        <td>{{ $item->hari }}</td>
        <td>{{ $item->jam_mulai }}-{{$item->jam_akhir}}</td>
        <td>
            <form action="{{ route('krs.store') }}" method="POST" style="display: inline;">
                @csrf
                <input type="hidden" name="id_jadwal" value="{{$item->id_jadwal}}">
                <button class="btn btn-outline-secondary" name="matkul" value="{{$item->nama}}" type="submit">tambah</button>
            </form>
        </td>
    </tr>
    @php
        $i++;
    @endphp
@endforeach
