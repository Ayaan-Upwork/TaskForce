<div class="sidebar" data-color="purple" data-background-color="black" data-image="../assets/img/sidebar-2.jpg">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

    Tip 2: you can also add an image using data-image tag
-->
  <div style="padding-left: 30px" class="logo "><img src="{{url('assets/logo.png')}}" class="img-fluid text-center" width="150" height="120"></div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item {{ Request::is('dashboard') ? 'active':'' }} ">
        <a class="nav-link" href="{{ url('dashboard')}}">
          <i class="material-icons">dashboard</i>
          <p>Dashboard</p>
        </a>
      </li>
      {{-- <li class="nav-item  {{ Request::is('locations') ? 'active':'' }}"> --}}
      <li class="nav-item  {{ request()->segment(1) == 'locations' ? 'active':'' }}">
        <a class="nav-link" href="{{ url('locations') }}">
          <i class="material-icons">store</i>
          <p>Location</p>
        </a>
      </li>
      {{-- <li class="nav-item  {{ Request::is('employes') ? 'active':'' }}"> --}}
      <li class="nav-item  {{ request()->segment(1) == 'employes' ? 'active':'' }}">
        <a class="nav-link" href="{{ url('employes') }}">
          <i class="material-icons">badge</i>
          <p>Employee</p>
        </a>
      </li>
      {{-- <li class="nav-item  {{ request()->segment(1) == 'shifts' ? 'active':'' }}">
        <a class="nav-link" href="{{ url('shifts') }}">
          <i class="material-icons">manage acounts</i>
          <p>Shift</p>
        </a>
      </li> --}}
      <li @if (Request::is('roasters') || Request::is('roaster/add') || request()->segment(1) == 'roaster' ) class="active" @else class="nav-item" @endif>
        <a class="nav-link" href="{{ url('roasters') }}">
          <i class="material-icons">engineering</i>
          <p>Roaster</p>
        </a>
      </li>
      <li class="nav-item   {{ request()->segment(2) == 'report' ? 'active':'' }}">
        <a class="nav-link" href="{{ url('roasters/report') }}">
          <i class="material-icons">report</i>
          <p>Employee Hours Report</p>
        </a>
      </li>
      <li class="nav-item  {{ request()->segment(2) == 'reports' ? 'active':'' }}">
        <a class="nav-link" href="{{ url('leave/reports') }}">
          <i class="material-icons">report</i>
          <p>Employee Holiday Report</p>
        </a>
      </li>
      {{-- <li class="nav-item  {{ Request::is('leaves') ? 'active':'' }}">
        <a class="nav-link" href="{{ url('leaves') }}">
          <i class="material-icons">person</i>
          <p>Employe Leaves</p>
        </a>
      </li> --}}
      <li class="nav-item  {{ Request::is('view-leaves') ? 'active':'' }}">
        <a class="nav-link" href="{{ url('view-leaves') }}">
          <i class="material-icons">person</i>
          <p>Employee Holidays</p>
        </a>
      </li>
    </ul>
  </div>
</div>