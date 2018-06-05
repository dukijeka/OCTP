<div class="imgcontainer">
    <img src = "{{asset('images/Logo.png')}}" alt = "OCTP" class = "logo">
</div>	
<div class = "meni">
    <ul>
        <li>
            <a href="/home">
                Home
            </a>
        </li>
        <li>
            <a href="/document/showAll" class="dropbtn">
                All documents
            </a>
        </li>
        @if (Auth::check())
            <li>
                <a href="/document/my" class="dropbtn">
                    My documents
                </a>
            </li>
            <li>
                <a href="/document/create" class="dropbtn">
                    Upload document
                </a>
            </li>
            @if (Auth::user()->isAdmin())
            <li>
                <a href="/user/showAllUsers" class="dropbtn">
                    Search Users
                </a>
            </li>
            @endif
            <li>
                <a href="/translation" class="dropbtn">
                    My translations
                </a>
            </li>
        @endif
        @if (Auth::check())
            @if(Auth::user()->isAdminOrModerator())
                <li>
                    <a href="/report" class="dropbtn">
                        Reports
                    </a>
                </li>
            @else
                <li>
                    <a href="/report/my" class="dropbtn">
                        My reports
                    </a>
                </li>
            @endif
        @endif

        @if (Auth::check())
            <li style="float:right">
                <a href="{{ url('user/'.Auth::id()) }}">
                    My Profile
                </a>
            </li>
            <li style="float:right">
                <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        @else
            <li style="float:right" class="dropdown">
                <a href="/login" class="dropbtn">
                    Login
                </a>
            </li>
            <li style="float:right" class="dropdown">
                <a href="/register" class="dropbtn">
                    Register
                </a>
            </li>
        @endif

    </ul>
</div>