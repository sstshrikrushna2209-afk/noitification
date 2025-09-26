<style>
    /* User Info Section */
    .sidebar-user-info {
        /*margin: 0 0.5rem 1rem;*/
        /*padding: 1.5rem 0.5rem;*/
        text-align: center;
        border-radius: 8px;
        display: flex;
        justify-content: center;
    }
    
    .sidebar-user-avatar {
        width: 40px;
        height: 40px;
        margin: 0 auto 0.75rem;
        border-radius: 50%;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4a6baf;
        border: 3px solid #e0e5ec;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    
    .sidebar-user-avatar .bi-person-circle {
        font-size: 0.5rem;
    }
    
    .sidebar-user-name h6 {
        font-weight: 600;
        color: #333;
        /*margin-bottom: 0.25rem;*/
        font-size: 0.9rem;
    }
    
    .sidebar-user-name small {
        font-size: 0.8rem;
        color: #6c757d;
        display: inline-block;
        padding: 0.15rem 0.5rem;
        background-color: #f8f9fa;
        border-radius: 12px;
    }
    
    /* Hover effects */
    .sidebar-user-avatar:hover {
        transform: scale(1.05);
        transition: all 0.3s ease;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    /* Dropdown Styling - New Implementation */
    .nav-item.dropdown .dropdown-menu {
        display: none;
        position: static;
        float: none;
        width: 100%;
        margin: 0;
        padding: 0;
        border: none;
        background-color: transparent;
    }

    .nav-item.dropdown.show .dropdown-menu {
        display: block;
    }

    .dropdown-item {
        padding: 0.5rem 1rem 0.5rem 2.5rem !important;
        border-radius: 4px;
        transition: all 0.2s;
        color: #000 !important;
        margin-bottom: 2px;
        display: block;
    }

    .dropdown-toggle {
        cursor: pointer;
        position: relative;
    }

    .dropdown-toggle::after {
        display: inline-block;
        margin-left: 0.255em;
        vertical-align: 0.255em;
        content: "";
        border-top: 0.3em solid;
        border-right: 0.3em solid transparent;
        border-bottom: 0;
        border-left: 0.3em solid transparent;
        transition: transform 0.3s ease;
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
    }

    .dropdown-toggle[aria-expanded="true"]::after {
        transform: translateY(-50%) rotate(180deg);
    }
    
    /* ======================
   SIDEBAR ACTIVE LINK STYLING
   ====================== */
.nav-item .nav-link.active {
  background-color: #F96170 !important;  /* Apply desired color */
  color: white !important; /* Ensure the text is white when active */
  border-radius: 8px;  /* Rounded corners for active state */
}

.nav-item .nav-link.active:hover {
  background-color: #F96170 !important;  /* Keep the color when hovering over the active link */
  color: white !important; /* Keep text white on hover */
  transform: scale(1.05); /* Slight zoom effect */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Light shadow on hover */
  transition: all 0.3s ease; /* Smooth transition for hover effect */
}

/* Link Styling */
.nav-item .nav-link {
  padding: 0.5rem 1.25rem;
  font-size: 1rem;
  color: #333;  /* Default text color */
  display: block;
  border-radius: 4px;
  transition: all 0.3s ease;
}

/* Hover effect for non-active links */
.nav-item .nav-link:hover {
  background-color: #f1f1f1;  /* Light gray on hover for non-active links */
  color: #2c3e50;  /* Dark gray text for better visibility */
  transform: scale(1.05); /* Slight zoom effect on hover */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Light shadow on hover */
}

/* Sidebar Dropdown active link */
.nav-item .nav-link.dropdown-toggle.active {
  background-color: #F96170 !important;  /* Apply the same color to dropdown active state */
  color: white !important;
  border-radius: 8px; /* Rounded corners for active dropdown */
}

/* Styling for dropdown links */
.dropdown-item.active {
  background-color: #F96170 !important;
  color: white !important;
  border-radius: 8px;
  transition: all 0.3s ease;
  margin: 6px 0 0 0;
}

.dropdown-item.active:hover {
  background-color: #F96170 !important;  /* Ensure consistency with active link hover */
  color: white;
  transform: scale(1.05);  /* Zoom effect on hover */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  /* Light shadow on hover */
}

</style>
<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$academicPages = ['qa_new.php', 'subjects.php', 'file_manager_new.php', 'attendance_new.php'];
$isAcademicActive = in_array($currentPage, $academicPages);
?>
<!-- sidebar_admin.php -->
<div class="d-flex flex-column flex-shrink-0 p-3 shadow sidebar" id="sidebar">
  <!-- Mobile Close Button -->
  <div class="sidebar-close d-lg-none text-end mb-2">
    <button class="btn btn-sm btn-light sidebar-toggle-close">
      <i class="fas fa-times"></i>
    </button>
  </div>
  
  <!-- Brand Logo & Name -->
  <a href="/" class="d-flex align-items-center text-decoration-none mb-2">
    <img src="../assets/logo.png" alt="Sayu Softtech" width="40" class="me-2">
    <div class="d-flex flex-column">
      <span class="fs-4 fw-bold text-dark">Sayu Softtech</span>
      <p class="text-dark m-0" style="font-size: 12px;">We Make your dream a reality</p>
    </div>
  </a>
  
  <div class="sidebar-user-info text-center m-0">
    <!--<div class="sidebar-user-avatar mb-3" style="">-->
    <!--    <i class="bi bi-person-circle fs-1"></i>-->
    <!--</div>-->
    <div class="sidebar-user-name">
        <h6 class="ms-1">Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>!</h6>
        <small class="text-muted"><?php echo htmlspecialchars($_SESSION['role'] ?? 'Admin'); ?></small>
    </div>
  </div>
  <hr class="my-2">
  
  <!-- Main Navigation -->
  <ul class="nav nav-pills flex-column mb-auto">
    <?php
    $currentPage = basename($_SERVER['PHP_SELF']);
    ?>
    <li class="nav-item">
      <a href="dashboard_new.php" class="nav-link <?php echo ($currentPage == 'dashboard_new.php') ? 'active' : 'text-dark'; ?>">
        <i class="bi bi-speedometer2 me-2"></i> 
        <span class="menu-text">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="inquiry_new.php" class="nav-link <?php echo ($currentPage == 'inquiry_new.php') ? 'active' : 'text-dark'; ?>">
        <i class="bi bi-chat-left-text me-2"></i>
        <span class="menu-text">Inquiries</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="admin_student.php" class="nav-link <?php echo ($currentPage == 'admin_student.php') ? 'active' : 'text-dark'; ?>">
        <i class="bi bi-chat-left-text me-2"></i>
        <span class="menu-text">Student</span>
      </a>
    </li>
    <li class="nav-item dropdown academic-dropdown <?php echo ($isAcademicActive ? 'show' : ''); ?>">
        <a class="nav-link dropdown-toggle <?php echo ($isAcademicActive ? 'active' : 'text-dark'); ?>" 
           href="#" 
           role="button" 
           data-bs-toggle="dropdown"
           aria-expanded="<?php echo $isAcademicActive ? 'true' : 'false'; ?>"
           style="<?php if($isAcademicActive) echo 'background-color:#f96170;color:#fff;'; ?>">
            <i class="bi bi-book me-2"></i>
            <span class="menu-text">Academic</span>
        </a>
        <ul class="dropdown-menu academic-dropdown-menu" aria-labelledby="academicDropdownToggle">
            <li><a class="dropdown-item <?php echo ($currentPage == 'qa_new.php') ? 'active' : ''; ?>" href="qa_new.php">Interview QA</a></li>
            <li><a class="dropdown-item <?php echo ($currentPage == 'attendance_new.php') ? 'active' : ''; ?>" href="attendance_new.php">Attendance</a></li>
            <li><a class="dropdown-item <?php echo ($currentPage == 'file_manager_new.php') ? 'active' : ''; ?>" href="file_manager_new.php">File Manager</a></li>
            <li><a class="dropdown-item <?php echo ($currentPage == 'placement_tracker_new.php') ? 'active' : ''; ?>" href="placement_tracker_new.php">Placement Tracker</a></li>
        </ul>
    </li>
    <li class="nav-item">
      <a href="tasks_new.php" class="nav-link <?php echo ($currentPage == 'tasks_new.php') ? 'active' : 'text-dark'; ?>">
        <i class="bi bi-people me-2"></i>
        <span class="menu-text">Task</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="candidates.php" class="nav-link <?php echo ($currentPage == 'candidates.php') ? 'active' : 'text-dark'; ?>">
        <i class="bi bi-people me-2"></i>
        <span class="menu-text">Candidates</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="reports.php" class="nav-link <?php echo ($currentPage == 'reports.php') ? 'active' : 'text-dark'; ?>">
        <i class="bi bi-graph-up me-2"></i>
        <span class="menu-text">Reports</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="settings.php" class="nav-link <?php echo ($currentPage == 'settings.php') ? 'active' : 'text-dark'; ?>">
        <i class="bi bi-gear me-2"></i>
        <span class="menu-text">Settings</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="Admin_data.php" class="nav-link <?php echo ($currentPage == 'Admin_data.php') ? 'active' : 'text-dark'; ?>">
        <i class="bi bi-gear me-2"></i>
        <span class="menu-text">Old Dashboard</span>
      </a>
    </li>
     <li class="nav-item">
      <a href="create.php" class="nav-link <?php echo ($currentPage == '/NotificationAdminPanel/admin/create.php') ? 'active' : 'text-dark'; ?>">
      <i class="fa-solid fa-bell"></i>
        <span class="menu-text">Notifications</span>
      </a>
    </li>
  </ul>
  
  <!--<hr class="my-2">-->
  
  <!-- User Dropdown -->
  <div class="dropdown mt-auto">
    <a href="logout.php" class="d-flex align-items-center text-decoration-none text-danger fs-5" > <i class="fas fa-sign-out-alt me-2"></i>Logout</a>
  </div>
</div>