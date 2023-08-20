<li class="menu-title text-purple"><b>Main</b></li>
                    
<li>
    <a href="{{ route('home') }}"><i class="mdi mdi-application"></i><span>Home</span></a>
</li>
{{-- @foreach ($menu as $menu) --}}
    

    @if(auth()->user()->level=='A')
        
        <li class="menu-title text-purple"><b>Sekolah</b></li>

            <li>
                <a href="{{ route('tahun.index') }}"><i class="mdi mdi-calendar"></i><span>Tahun Ajaran</span></a>
            </li>

            <li>
                <a href="{{ route('daftar.index') }}"><i class="mdi mdi-calendar"></i><span>Tahun Daftar</span></a>
            </li>

            <li>
                <a href="{{ route('siswa.index') }}"><i class="mdi mdi-account-group"></i><span>Siswa</span></a>
            </li>

            <li>
                <a href="{{ route('kelas.index') }}"><i class="mdi mdi-chess-queen"></i><span>Kelas</span></a>
            </li>

            <li>
                <a href="{{ route('peserta.index') }}"><i class="mdi mdi-account-group text-danger"></i><span>Peserta</span></a>
            </li>

        <li class="menu-title text-purple"><b>SPK</b></li>

            <li>
                <a href="{{ route('periode.index') }}"><i class="mdi mdi-calendar-check-outline"></i><span>Periode</span></a>
            </li>
            <li>
                <a href="{{ route('kriteria.index') }}"><i class="mdi mdi-chemical-weapon"></i><span>Kriteria</span></a>
            </li>
            <li>
                <a href="{{ route('kuantitatif.index') }}"><i class="mdi mdi-dialpad"></i><span>Kuantitatif</span></a>
            </li>
            <li>
                <a href="{{ route('penilaian.index') }}"><i class="mdi mdi-certificate text-danger"></i><span>Penilaian</span></a>
            </li>

        <li class="menu-title text-purple"><b>Setting</b></li>

            <li>
                <a href="{{ route('users.index') }}"><i class="mdi mdi-account-multiple-outline"></i><span>Manajemen Users</span></a>
            </li>

            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form-sidebar').submit();"><i class="mdi mdi-power text-danger"></i><span>Logout</span></a>

                <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {!! csrf_field() !!}
                </form>
            </li>

    @elseif(auth()->user()->level=='K')

        <li class="menu-title text-purple"><b>SPK</b></li>

            <li>
                <a href="{{ route('penilaian.index') }}"><i class="mdi mdi-certificate text-danger"></i><span>Penilaian</span></a>
            </li>

        <li class="menu-title text-purple"><b>Setting</b></li>

            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form-sidebar').submit();"><i class="mdi mdi-power text-danger"></i><span>Logout</span></a>

                <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {!! csrf_field() !!}
                </form>
            </li>

    @endif

{{-- @endforeach --}}