<nav class="main-header navbar navbar-expand navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button">
        <i class="fas fa-bars"></i>
      </a>
    </li>
  </ul>

  <ul class="navbar-nav ml-auto">

    <li class="nav-item dropdown"> 

      <a class="nav-link" data-toggle="dropdown" href="#" role="button">
        {{ auth()->user()->nama }} <i class="fas fa-caret-down ml-1"></i>
      </a>

      <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        
        <a class="dropdown-item" href="{{ route('profile') }}">
          <i class="fas fa-user mr-2"></i> Ubah Profile
        </a>

        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt mr-2 text-danger"></i> Keluar
        </a>
        <form action="{{ route('logout') }}" id="logout-form" method="POST">
          @csrf
        </form>

      </div>

    </li>

  </ul>
</nav>