<header>
  <div class="navbar navbar-expand-sm bg-light navbar-light justify-content-between fixed-top">
    <a class="navbar-brand" href="{{route('home')}}">
        <strong>
          {{env('APP_NAME')}} 
        </strong>
      </a>
    <ul class="navbar-nav">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <li class="nav-item btn btn-sm btn-outline-primary mr-1">
          <a class="nav-link navbar-dark" href="{{route('home')}}">Home</a>
        </li>
        <li class="nav-item btn btn-sm btn-outline-primary mr-1">
          <a class="nav-link navbar-dark" href="#">About</a>
        </li>
        <li class="nav-item btn btn-sm btn-outline-primary mr-1">
          <a class="nav-link navbar-dark" href="/contact">Contact</a>
        </li>
        @can('create-badges')
        <li class="nav-item btn btn-sm btn-outline-primary mr-1">
          <a class="nav-link navbar-dark" href="{{route('createBadge')}}">Create Badge</a>
        </li>
        <li class="nav-item btn btn-sm btn-outline-primary mr-1">
          <a class="nav-link navbar-dark" href="{{route('userStatistics')}}">Users statistics</a>
        </li>
        @endcan
      </ul>
      <ul class="navbar-nav">
        @if(auth()->check())
        <li class="nav-item btn btn-sm btn-outline-primary mr-1">
          <a class="nav-link navbar-dark">{{auth()->user()->name}}</a>
        </li>
        <li class="nav-item btn btn-sm btn-outline-primary mr-1">
          <a class="nav-link navbar-dark" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">Logout</a>
        </li>
        @else

        <li class="nav-item btn btn-sm btn-outline-primary mr-1">
          <a class="nav-link navbar-dark" href="{{route('login')}}">Login</a>
        </li>

        <li class="nav-item btn btn-sm btn-outline-primary mr-1">
          <a class="nav-link navbar-dark" href="{{route('register')}}">Register as a new user</a>
        </li>
        @endif
      </ul>


    
      </ul>
    </div>
    </div>

    <form method="POST" action="{{route('logout')}}" id="logoutForm" style="display:none">
      {{csrf_field()}}
    </form>


  </div>
</header>