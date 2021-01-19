<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="profile-image">
            <img class="img-mdm rounded-circle" src="{{ asset('assets/images/faces/face8.jpg') }}" alt="profile image">
            <div class="dot-indicator bg-success"></div>
          </div>
          <div class="text-wrapper">
            <p class="profile-name">{{ session('name') }}</p>
            <p class="designation">{{ session('role') }}</p>
          </div>
        </a>
      </li>
      <li class="nav-item nav-category"></li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('home')}}">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title">Today's Tracker</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('user.tracker')}}">
          <i class="menu-icon typcn typcn-coffee"></i>
          <span class="menu-title">My Tracker</span>
          <i class="menu-arrow"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('calendar.list') }}">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title">My Calendar Tracker</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('attendance.list') }}">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title">Attendances</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('employee.list')}}">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title">Employee</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('account.list')}}">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title">Accounts</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('overbreak.list')}}">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title">Over Breaks</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('schedule.list')}}">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title">Schedules</span>
        </a>
      </li>
    </ul>
  </nav>