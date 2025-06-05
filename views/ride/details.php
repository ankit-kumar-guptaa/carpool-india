<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carpool India - Ride Details</title>
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
        <h2>Ride Details</h2>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>
        <p><strong>Source:</strong> <?php echo htmlspecialchars($ride['source']); ?></p>
        <p><strong>Destination:</strong> <?php echo htmlspecialchars($ride['destination']); ?></p>
        <p><strong>Date:</strong> <?php echo htmlspecialchars($ride['ride_date']); ?></p>
        <p><strong>Time:</strong> <?php echo htmlspecialchars($ride['ride_time']); ?></p>
        <p><strong>Seats Available:</strong> <?php echo htmlspecialchars($ride['seats_available']); ?></p>
        <p><strong>Ride Type:</strong> <?php echo htmlspecialchars($ride['ride_type']); ?></p>
        <p><strong>Comment:</strong> <?php echo htmlspecialchars($ride['comment'] ?: 'No comment'); ?></p>
        <p><strong>Pooler:</strong> <?php echo htmlspecialchars($ride['name']); ?></p>
        <?php
        $booking_status = null;
        $query = "SELECT status FROM bookings WHERE ride_id = :ride_id AND user_id = :user_id";
        $db = (new Database())->connect();
        $stmt = $db->prepare($query);
        $stmt->bindParam(':ride_id', $ride['id']);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->execute();
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($booking && $booking['status'] == 'accepted') {
            echo '<p><strong>Pooler Phone:</strong> ' . htmlspecialchars($ride['phone']) . '</p>';
        } else {
            echo '<p><strong>Pooler Phone:</strong> Available after booking is accepted</p>';
        }
        ?>
        <form method="POST" class="w-50">
            <input type="hidden" name="ride_id" value="<?php echo $ride['id']; ?>">
            <div class="mb-3">
                <label for="seats_booked" class="form-label">Seats to Book</label>
                <input type="number" name="seats_booked" id="seats_booked" class="form-control" min="1" max="<?php echo $ride['seats_available']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Book Ride</button>
        </form>
        <a href="?controller=ride&action=create" class="btn btn-secondary mt-3">Back to Rides</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>