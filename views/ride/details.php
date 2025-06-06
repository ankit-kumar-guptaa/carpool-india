<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carpool India - Ride Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Include Header -->
    <?php include 'views/partials/header.php'; ?>

    <div class="container mt-5">
        <h2>Ride Details</h2>

        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php } ?>

        <?php if (isset($ride) && !empty($ride)) { ?>
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($ride['source']); ?> <i class="fas fa-arrow-right"></i> <?php echo htmlspecialchars($ride['destination']); ?></h5>
                    <p class="card-text">
                        <strong><i class="fas fa-calendar-alt"></i> Date:</strong> <?php echo htmlspecialchars($ride['ride_date']); ?><br>
                        <strong><i class="fas fa-clock"></i> Time:</strong> <?php echo htmlspecialchars($ride['ride_time']); ?><br>
                        <strong><i class="fas fa-chair"></i> Seats Available:</strong> <?php echo htmlspecialchars($ride['seats_available']); ?><br>
                        <strong><i class="fas fa-road"></i> Ride Type:</strong> <?php echo htmlspecialchars($ride['ride_type']); ?><br>
                        <strong><i class="fas fa-comment"></i> Comment:</strong> <?php echo htmlspecialchars($ride['comment'] ?: 'No comment'); ?><br>
                        <strong><i class="fas fa-user"></i> Pooler:</strong> <?php echo htmlspecialchars($ride['name']); ?><br>
                        <strong><i class="fas fa-phone"></i> Pooler Phone:</strong> 
                        <?php if ($booking_status == 'accepted') { ?>
                            <?php echo htmlspecialchars($ride['phone']); ?>
                        <?php } else { ?>
                            Available after booking is accepted
                        <?php } ?>
                    </p>
                </div>
            </div>

            <?php if ($ride['seats_available'] > 0) { ?>
                <form action="?controller=ride&action=book" method="POST" class="w-50">
                    <input type="hidden" name="ride_id" value="<?php echo htmlspecialchars($ride['id']); ?>">
                    <div class="mb-3">
                        <label for="seats_booked" class="form-label">Seats to Book</label>
                        <input type="number" name="seats_booked" id="seats_booked" class="form-control" min="1" max="<?php echo htmlspecialchars($ride['seats_available']); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Book Ride</button>
                </form>
            <?php } else { ?>
                <div class="alert alert-warning">No seats available for this ride.</div>
            <?php } ?>
        <?php } else { ?>
            <div class="alert alert-danger">Ride details not available.</div>
        <?php } ?>

        <a href="?controller=ride&action=search" class="btn btn-secondary mt-3">Back to Search Rides</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>