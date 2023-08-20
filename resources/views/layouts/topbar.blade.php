<div class="topbar-left">
    <a href="{{ route('home') }}" class="logo">
        <span>
            <img src="{{ asset('resources/sources/images/logo-spk.png') }}" alt="logo-large" class="logo-lg" width="200px">
        </span>
    </a>
</div>

<ul class="list-unstyled topbar-nav float-right mb-0">

    <li class="dropdown">
        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
            aria-haspopup="false" aria-expanded="false">
            <small>Salam Semangat, <b>{{ Auth::user()->name }}</b></small>&nbsp;&nbsp;<img src="{{ asset('resources/sources/images/user-1.jpg') }}" alt="profile-user" class="rounded-circle" /> 
            <span class="ml-1 nav-user-name hidden-sm"> <i class="mdi mdi-chevron-down"></i> </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form-top').submit();"><i class="dripicons-exit text-muted mr-2"></i> Logout</a>
        </div>
    </li>
    <form id="logout-form-top" action="{{ route('logout') }}" method="POST" style="display: none;">
        {!! csrf_field() !!}
    </form>
</ul>

<ul class="list-unstyled topbar-nav mb-0">
        
    <li>
        <button class="button-menu-mobile nav-link waves-effect waves-light">
            <i class="mdi mdi-menu nav-icon"></i>
        </button>
    </li>
    
</ul>