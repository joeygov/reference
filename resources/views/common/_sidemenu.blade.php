<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="profile-image">
            <img class="img-mdm rounded-circle" src="assets/images/faces/face8.jpg" alt="profile image">
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
        <a class="nav-link" href="index.html">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title">Today's Tracker</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="menu-icon typcn typcn-coffee"></i>
          <span class="menu-title">My Tracker</span>
          <i class="menu-arrow"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title">My Calendar Tracker</span>
        </a>
      </li>
    </ul>
  </nav>