<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carpool India - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Carpool India</a>
            <div class="navbar-nav">
                <a class="nav-link" href="?controller=user&action=dashboard">Dashboard</a>
                <a class="nav-link" href="?controller=user&action=profile">Profile</a>
                <a class="nav-link" href="?controller=ride&action=create">Rides</a>
                <a class="nav-link" href="?controller=user&action=my_rides">My Rides</a>
                <a class="nav-link" href="?controller=user&action=my_connections">My Connections</a>
                <a class="nav-link" href="?controller=auth&action=logout">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h2>
        <p>Role: <?php echo htmlspecialchars($user['role']); ?></p>
        <div class="row">
            <div class="col-md-6">
                <a href="?controller=ride&action=create" class="btn btn-primary w-100 mb-3">Create/Search Rides</a>
            </div>
        </div>
        <?php if (!empty($rides)) { ?>
            <h3>Your Created Rides</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Source</th>
                        <th>Destination</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Seats Available</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rides as $ride) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($ride['source']); ?></td>
                            <td><?php echo htmlspecialchars($ride['destination']); ?></td>
                            <td><?php echo htmlspecialchars($ride['ride_date']); ?></td>
                            <td><?php echo htmlspecialchars($ride['ride_time']); ?></td>
                            <td><?php echo htmlspecialchars($ride['seats_available']); ?></td>
                            <td>
                                <a href="?controller=ride&action=manageBookings&ride_id=<?php echo $ride['id']; ?>" class="btn btn-primary btn-sm">Manage Bookings</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>No rides created yet.</p>
        <?php } ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>