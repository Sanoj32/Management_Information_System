<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        {{-- Flashing session data --}}
        @if (session('attendanceSuccess'))
        <div class="alert alert-success">
            {{ session('attendanceSuccess') }}
        </div>
        @endif

        @if (session('attendanceUpdateSuccess'))
        <div class="alert alert-success">
            {{ session('attendanceUpdateSuccess') }}
        </div>
        @endif

        @if (session('attendanceUpdateFailed'))
        <div class="alert alert-danger">
            {{ session('attendanceUpdateFailed') }}
        </div>
        @endif

        @if(session('attendanceFailed'))
        <div class="alert alert-danger">
            {{ session('attendanceFailed') }}
        </div>
        @endif

        @if(session('duplicateAttendance'))
        <div class="alert alert-danger">
            {{session('duplicateAttendance')}}
        </div>
        @endif
        @if(session('duplicateReport'))
        <div class="alert alert-danger">
            {{session('duplicateReport')}}
        </div>
        @endif
        <a class="navbar-brand p4-4" href="{{ url('/') }}">
            LEC M.I.S.
        </a>


        <a class="navbar-brand " style="text-align:center;" href="{{ url('/updates') }}">
            Updates
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @if(Auth::guard('web')->check())
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::guard('web')->user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a href="{{route('teacher.home')}}" class="dropdown-item">Dashboard</a>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault();document.querySelector('#logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @else
                @endif
                @if(Auth::guard('admin')->check())
                <li class="nav-item dropdown">
                    <a id="adminDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::guard('admin')->user()->name }} (ADMIN) <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDropdown">
                        <a href="{{route('admin.home')}}" class="dropdown-item">Dashboard</a>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault();document.querySelector('#admin-logout-form').submit();">
                            Logout
                        </a>
                        <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>

                @endif
            </ul>
        </div>

    </div>
</nav>
