<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
        </button>
        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                @if (auth()->user())
                    <li class="nav-item active">
                        {{auth()->user()->level}} : {{auth()->user()->name}}
                    </li>
                    
                @endif
                @unless ($active == 'jadwal-dosen')
                    <li class="nav-item active">
                        @if ($active == 'jadwal-matkul')
                            <form action="{{ route($active . '.create') }}" method="GET">
                                <select name="nama" class="form-control">
                                    <option selected>Select Mata Kuliah</option>
                                    @foreach ($select as $item)
                                        <option value="{{ $item->nama }}"> {{ $item->nama }} </option>
                                    @endforeach
                                </select>
                                <div class="input-group">
                                    <button class="btn btn-primary mt-2">Create data</button>
                                </div>
                            </form>
                        @else
                            @unless ($active == '/' or $active == 'user-manejement' or !auth()->user())
                                <a class ="btn btn-primary mt-2" href="{{ route($active . '.create') }}">Create data</a>
                            @endunless
                        @endif
                    </li>

                @endunless
            </ul>
        </div>
    </div>
</nav>
