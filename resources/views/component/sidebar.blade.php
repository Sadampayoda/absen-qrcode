<nav id="sidebar" class="active bg-warning">
    <h1 class="border-bottom pb-3"><img src="{{asset('logo.png')}}"  class="logo img-fluid"></h1>
    <ul class="list-unstyled components mb-5">
        <li class="active">
            <a href="{{ route('dashboard.index') }}"><span class="bi bi-speedometer2"></span>Dashboard</a>
        </li>
        
        @if (auth()->user())
            @if (auth()->user()->level == 'admin')
                <li class="active">
                    <a href="{{ route('jam.index') }}"><span class="bi bi-alarm-fill pe-2"></span>Jam kuliah</a>
                </li>
                <li>
                    <a href="{{ route('user-manejement.index') }}"><span class="fa fa-user"></span> User Manajement</a>
                </li>
                <li>
                    <a href="{{ route('ruang.index') }}"><span class="bi bi-grid-3x3-gap-fill"></span> Ruangan</a>
                </li>
                <li>
                    <a href="{{ route('mata-kuliah.index') }}"><span class="fa fa-book"></span> Mata Kuliah</a>
                </li>
                
                <li>
                    <a href="{{ route('jadwal-matkul.index') }}"><span class="bi bi-calendar3"></span>Jadwal Mata
                        Kuliah</a>
                </li>
                <li>
                    <a href="{{route('pengaturan.index')}}"><span class="bi bi-megaphone"></span> Periode</a>
                </li>
            @elseif (auth()->user()->level == 'dosen')
                <li>
                    <a href="{{ route('jadwal-dosen') }}"><span class="fa fa-book"></span>Jadwal Mata kuliah</a>
                </li>
                <li>
                    <a href="{{ route('nilai.index') }}"><span class="fa fa-bar-chart"></span>Penilaian</a>
                </li>
            @else
                <li>
                    <a href="{{ route('krs.index') }}"><span class="fa fa-book"></span>KRS</a>
                </li>
                <li>
                    <a href="{{ route('dashboard.khs') }}"><span class="fa fa-bar-chart"></span>KHS</a>
                </li>
                <li>
                    <a href="{{ route('dashboard.transkip') }}"><span class="bi bi-graph-up"></span>Transkip nilai</a>
                </li>

            @endif
            <li>
                <a href="{{ route('dashboard.logout') }}"><span class="fa fa-cogs"></span>Logout</a>
            </li>
        @else
            <li>
                <a href="{{route('dashboard.login')}}"><span class="fa fa-cogs"></span>Login</a>
            </li>
        @endif

    </ul>


</nav>
