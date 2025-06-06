<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carpool India - My Rides</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Include Header -->
    <?php include 'views/partials/header.php'; ?>

    <div class="container mt-5">
        <h2>My Rides</h2>

        <!-- Created Rides Section -->
        <h3>Created Rides</h3>
        <?php if (isset($created_rides) && !empty($created_rides)) { ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Journey Date</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($created_rides as $ride) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($ride['ride_date']); ?> at <?php echo htmlspecialchars($ride['ride_time']); ?></td>
                            <td><?php echo htmlspecialchars($ride['source']); ?></td>
                            <td><?php echo htmlspecialchars($ride['destination']); ?></td>
                            <td>
                                <?php
                                $ride_date = new DateTime($ride['ride_date'] . ' ' . $ride['ride_time']);
                                $current_date = new DateTime(); // Dynamic current date and time
                                echo $ride_date > $current_date ? 'Upcoming' : 'Completed';
                                ?>
                            </td>
                            <td>
                                <a href="?controller=ride&action=book&ride_id=<?php echo $ride['id']; ?>" class="btn btn-primary btn-sm">View</a>
                                <?php if ($ride_date > $current_date) { ?>
                                    <a href="?controller=ride&action=cancelRide&ride_id=<?php echo $ride['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to cancel this ride?');">Cancel</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-info">No rides created yet.</div>
        <?php } ?>

        <!-- Booked Rides Section -->
        <h3>Booked Rides</h3>
        <?php if (isset($booked_rides) && !empty($booked_rides)) { ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Journey Date</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($booked_rides as $ride) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($ride['ride_date']); ?> at <?php echo htmlspecialchars($ride['ride_time']); ?></td>
                            <td><?php echo htmlspecialchars($ride['source']); ?></td>
                            <td><?php echo htmlspecialchars($ride['destination']); ?></td>
                            <td>
                                <?php
                                $ride_date = new DateTime($ride['ride_date'] . ' ' . $ride['ride_time']);
                                $current_date = new DateTime(); // Dynamic current date and time
                                if ($ride['status'] == 'pending') {
                                    echo 'Pending Approval';
                                } elseif ($ride['status'] == 'rejected') {
                                    echo 'Rejected';
                                } elseif ($ride_date > $current_date) {
                                    echo 'Upcoming';
                                } else {
                                    echo 'Completed';
                                }
                                ?>
                            </td>
                            <td>
                                <a href="?controller=ride&action=book&ride_id=<?php echo $ride['ride_id']; ?>" class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-info">No rides booked yet.</div>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>