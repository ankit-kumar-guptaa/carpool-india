<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carpool India - Manage Ride Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Include Header -->
    <?php include '../views/partials/header.php'; ?>

    <div class="container mt-5">
        <h2>Manage Ride Requests</h2>

        <?php if (isset($ride) && !empty($ride)) { ?>
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($ride['source']); ?> <i class="fas fa-arrow-right"></i> <?php echo htmlspecialchars($ride['destination']); ?></h5>
                    <p class="card-text">
                        <strong><i class="fas fa-calendar-alt"></i> Date:</strong> <?php echo htmlspecialchars($ride['ride_date']); ?><br>
                        <strong><i class="fas fa-clock"></i> Time:</strong> <?php echo htmlspecialchars($ride['ride_time']); ?><br>
                        <strong><i class="fas fa-chair"></i> Seats Available:</strong> <?php echo htmlspecialchars($ride['seats_available']); ?>
                    </p>
                </div>
            </div>

            <h3>Booking Requests</h3>
            <?php if (!empty($bookings)) { ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Seeker Name</th>
                            <th>Seats Requested</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $booking) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($booking['seeker_name']); ?></td>
                                <td><?php echo htmlspecialchars($booking['seats_booked']); ?></td>
                                <td><?php echo htmlspecialchars($booking['status']); ?></td>
                                <td>
                                    <?php if ($booking['status'] == 'pending') { ?>
                                        <form action="?controller=ride&action=manageBookings" method="POST" class="d-inline">
                                            <input type="hidden" name="ride_id" value="<?php echo htmlspecialchars($ride['id']); ?>">
                                            <input type="hidden" name="booking_id" value="<?php echo htmlspecialchars($booking['id']); ?>">
                                            <input type="hidden" name="status" value="accepted">
                                            <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                        </form>
                                        <form action="?controller=ride&action=manageBookings" method="POST" class="d-inline">
                                            <input type="hidden" name="ride_id" value="<?php echo htmlspecialchars($ride['id']); ?>">
                                            <input type="hidden" name="booking_id" value="<?php echo htmlspecialchars($booking['id']); ?>">
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                        </form>
                                    <?php } else { ?>
                                        <span class="badge bg-secondary"><?php echo htmlspecialchars($booking['status']); ?></span>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <div class="alert alert-info">No booking requests for this ride yet.</div>
            <?php } ?>
        <?php } else { ?>
            <div class="alert alert-danger">Ride not found or you don't have permission to manage this ride.</div>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>