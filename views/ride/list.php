<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carpool India - Available Rides</title>
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
                <a class="nav-link" href="?controller=ride&action=create">Create Ride</a>
                <a class="nav-link" href="?controller=ride&action=search">Search Rides</a>
                <a class="nav-link" href="?controller=auth&action=logout">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h2>Available Rides</h2>
        <?php if (empty($rides)) { ?>
            <div class="alert alert-info">No rides found.</div>
        <?php } else { ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Source</th>
                        <th>Destination</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Seats Available</th>
                        <th>Pooler</th>
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
                            <td><?php echo htmlspecialchars($ride['name']); ?></td>
                            <td>
                                <a href="?controller=ride&action=book&ride_id=<?php echo $ride['id']; ?>" class="btn btn-primary btn-sm">Book</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
        <a href="?controller=ride&action=search" class="btn btn-secondary">Back to Search</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>