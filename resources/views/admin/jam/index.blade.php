@extends('component.app')

@section('content')
<div class="container mt-4">
    <!-- Tabel Responsif -->
    @if (session()->has('success'))
        @include('component.alert',[
            'message' => session('success'),
            'status' => 'success'
        ])
    @endif
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Nomor</th>
                    <th scope="col">Senin</th>
                    <th scope="col">Selasa</th>
                    <th scope="col">Rabu</th>
                    <th scope="col">Kamis</th>
                    <th scope="col">Jumat</th>
                    <th scope="col">Sabtu</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $senen = 0;
                    $selasa = 0;
                    $rabu = 0;
                    $kamis = 0;
                    $jumat = 0;
                    $sabtu = 0;
                @endphp
                <!-- Isi tabel -->
                @for ($i = 0; $i <= 5; $i++)
                    <tr>
                        <th scope="row">Jam ke {{$i + 1}}</th>
                        @if ($SeninCount > 0)
                            @if ($Senin[$senen]->jam_mulai == $jam[$i])
                            
                                <td>{{$Senin[$senen]->jam_mulai}}:{{$Senin[$senen]->jam_akhir}}</td>
                                @if ($senen != $SeninCount - 1)
                                    @php
                                        $senen = $senen + 1;
                                    @endphp
                                    
                                @endif
                            @else
                                <td class="text-center">-</td>
                            @endif
                            
                        @else
                            <td class="text-center">-</td>

                        @endif
                        
                        @if ($SelasaCount > 0)
                            @if ($Selasa[$selasa]->jam_mulai == $jam[$i])
                            
                                <td>{{$Selasa[$selasa]->jam_mulai}}:{{$Selasa[$selasa]->jam_akhir}}</td>
                                @if ($selasa != $SelasaCount - 1)
                                    @php
                                        $selasa = $selasa + 1;
                                    @endphp
                                    
                                @endif
                            @else
                                <td class="text-center">-</td>
                            @endif
                        @else    
                            <td class="text-center">-</td>
                        @endif
                        @if ($RabuCount > 0)
                            @if ($Rabu[$rabu]->jam_mulai == $jam[$i])
                            
                                <td>{{$Rabu[$rabu]->jam_mulai}}:{{$Rabu[$rabu]->jam_akhir}}</td>
                                @if ($rabu != $RabuCount - 1)
                                    @php
                                        $rabu = $rabu + 1;
                                    @endphp
                                    
                                @endif
                            @else
                                <td class="text-center">-</td>
                            @endif
                        @else    
                            <td class="text-center">-</td>
                        @endif
                        @if ($KamisCount > 0)
                            @if ($Kamis[$kamis]->jam_mulai == $jam[$i])
                            
                                <td>{{$Kamis[$kamis]->jam_mulai}}:{{$Kamis[$kamis]->jam_akhir}}</td>
                                @if ($kamis != $KamisCount - 1)
                                    @php
                                        $kamis = $kamis + 1;
                                    @endphp
                                    
                                @endif
                            @else
                                <td class="text-center">-</td>
                            @endif
                        @else    
                            <td class="text-center">-</td>
                        @endif
                        @if ($JumatCount > 0)
                            @if ($Jumat[$jumat]->jam_mulai == $jam[$i])
                            
                                <td>{{$Jumat[$jumat]->jam_mulai}}:{{$Jumat[$jumat]->jam_akhir}}</td>
                                @if ($jumat != $JumatCount - 1)
                                    @php
                                        $jumat = $jumat + 1;
                                    @endphp
                                    
                                @endif
                            @else
                                <td class="text-center">-</td>
                            @endif
                        @else    
                            <td class="text-center">-</td>
                        @endif
                        @if ($SabtuCount > 0)
                            @if ($Sabtu[$sabtu]->jam_mulai == $jam[$i])
                            
                                <td>{{$Sabtu[$sabtu]->jam_mulai}}:{{$Sabtu[$sabtu]->jam_akhir}}</td>
                                @if ($sabtu != $SabtuCount - 1)
                                    @php
                                        $sabtu = $sabtu + 1;
                                    @endphp
                                    
                                @endif
                            @else
                                <td class="text-center">-</td>
                            @endif
                        @else    
                            <td class="text-center">-</td>
                        @endif
                        
                        
                    </tr>
                @endfor
                <!-- Isi tabel lainnya -->
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Hari</th>
                            <th scope="col">Jam Mulai</th>
                            <th scope="col">Jam Akhir</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->hari }}</td>
                            <td>{{ $item->jam_mulai }}</td>
                            <td>{{ $item->jam_akhir }}</td>
                            <td>
                                <form action="{{ route('jam.edit', ['jam' => $item->id]) }}" method="GET" style="display: inline;">
                                    <button class="btn btn-outline-secondary" type="submit">Edit</button>
                                </form>
                                <form action="{{ route('jam.destroy', ['jam' => $item->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-secondary" type="submit" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
@endsection