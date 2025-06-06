<nav class="navbar navbar-expand-lg shadow-sm" style="background: linear-gradient(90deg, #ff9933 0%, #ffffff 50%, #138808 100%);">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="/" style="color: #0a2239;">
            <span style="font-size: 1.7rem; font-weight: bold; letter-spacing: 1px;">
                <span style="color:#fffff;">Car</span>
                <span style="color:#138808;">pool</span>
                <span style="color:#0a2239;"> India</span>
            </span>
            <span style="margin-left:10px; font-size:1.5rem;">🇮🇳</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <!-- Rides Dropdown: Always visible, but Post Ride only for logged-in users -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" id="ridesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#0a2239;">
                        <i class="fas fa-car me-1"></i> Rides
                    </a>
                    <ul class="dropdown-menu border-0 shadow" aria-labelledby="ridesDropdown">
                        <li>
                            <a class="dropdown-item" href="?controller=ride&action=search"><i class="fas fa-search me-1"></i> Search Rides</a>
                        </li>
                        <?php if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) { ?>
                            <li>
                                <a class="dropdown-item" href="?controller=ride&action=create"><i class="fas fa-plus-circle me-1"></i> Post Ride</a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>

                <?php if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) { ?>
                    <!-- My Rides: Only for logged-in users -->
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="?controller=user&action=my_rides" style="color:#0a2239;"><i class="fas fa-car me-1"></i> My Rides</a>
                    </li>

                    <!-- Ride Requests: Only for logged-in users -->
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="?controller=ride&action=manageBookings" style="color:#0a2239;"><i class="fas fa-bell me-1"></i> Ride Requests</a>
                    </li>

                    <!-- My Connections: Only for logged-in users -->
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="?controller=user&action=my_connections" style="color:#0a2239;"><i class="fas fa-users me-1"></i> My Connections</a>
                    </li>

                    <!-- Dashboard: Only for logged-in users -->
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="?controller=user&action=dashboard" style="color:#0a2239;"><i class="fas fa-tachometer-alt me-1"></i> Dashboard</a>
                    </li>

                    <!-- Profile: Only for logged-in users -->
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="?controller=user&action=profile" style="color:#0a2239;"><i class="fas fa-user me-1"></i> Profile</a>
                    </li>

                    <!-- Logout: Only for logged-in users -->
                    <li class="nav-item">
                        <a class="nav-link btn px-3 ms-2" href="?controller=auth&action=logout" style="background:#ff9933; color:#fff; border-radius:20px;"><i class="fas fa-sign-out-alt me-1"></i> Logout</a>
                    </li>
                <?php } else { ?>
                    <!-- Login: Only for non-logged-in users -->
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="?controller=auth&action=login" style="color:#0a2239;"><i class="fas fa-sign-in-alt me-1"></i> Login</a>
                    </li>

                    <!-- Signup: Only for non-logged-in users -->
                    <li class="nav-item">
                        <a class="nav-link btn px-3 ms-2" href="?controller=auth&action=signup" style="background:#138808; color:#fff; border-radius:20px;"><i class="fas fa-user-plus me-1"></i> Signup</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<style>
    .navbar-nav .nav-link:hover, .navbar-nav .dropdown-toggle:hover {
        color: #ff9933 !important;
        background: rgba(255,255,255,0.2);
        border-radius: 10px;
        transition: 0.2s;
    }
    .navbar-nav .btn:hover {
        background: #0a2239 !important;
        color: #fff !important;
    }
    .dropdown-menu {
        min-width: 180px;
    }
</style>