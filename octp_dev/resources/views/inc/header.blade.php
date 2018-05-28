<div class="imgcontainer">
    <img src = "{{asset('images/Logo.png')}}" alt = "OCTP" class = "logo">
</div>	
<div class = "meni">
    <ul>
        <li>
            <a href="index.html">
                Home
            </a>
        </li>
        <li>
            <a href="About Us.html" class="dropbtn" target = "_blank">
                About Us
            </a>
        </li>
        <li>
            <a href="View documents.html" class="dropbtn" target = "_blank">
                View documents
            </a>
        </li>
        @if (Auth::check())
            <li style="float:right">
                <a href="MyProfile.html">
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