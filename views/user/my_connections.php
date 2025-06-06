<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carpool India - My Connections</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
     <!-- Include Header -->
    <?php include 'views/partials/header.php'; ?>

    <div class="container mt-5">
        <h2>My Connections</h2>

        <!-- Incoming Requests Section -->
        <h3>Incoming Requests (<?php echo count($incoming_requests); ?>)</h3>
        <?php if (!empty($incoming_requests)) { ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Seeker Name</th>
                        <th>Ride Date</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Seats Requested</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($incoming_requests as $request) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($request['seeker_name']); ?></td>
                            <td><?php echo htmlspecialchars($request['ride_date']); ?> at <?php echo htmlspecialchars($request['ride_time']); ?></td>
                            <td><?php echo htmlspecialchars($request['source']); ?></td>
                            <td><?php echo htmlspecialchars($request['destination']); ?></td>
                            <td><?php echo htmlspecialchars($request['seats_booked']); ?></td>
                            <td><?php echo htmlspecialchars($request['status']); ?></td>
                            <td>
                                <?php if ($request['status'] == 'pending') { ?>
                                    <a href="?controller=ride&action=manageBookings&ride_id=<?php echo $request['ride_id']; ?>" class="btn btn-primary btn-sm">Manage</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-info">No incoming requests.</div>
        <?php } ?>

        <!-- Outgoing Requests Section -->
        <h3>Outgoing Requests (<?php echo count($outgoing_requests); ?>)</h3>
        <?php if (!empty($outgoing_requests)) { ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Pooler Name</th>
                        <th>Ride Date</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Seats Requested</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($outgoing_requests as $request) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($request['pooler_name']); ?></td>
                            <td><?php echo htmlspecialchars($request['ride_date']); ?> at <?php echo htmlspecialchars($request['ride_time']); ?></td>
                            <td><?php echo htmlspecialchars($request['source']); ?></td>
                            <td><?php echo htmlspecialchars($request['destination']); ?></td>
                            <td><?php echo htmlspecialchars($request['seats_booked']); ?></td>
                            <td><?php echo htmlspecialchars($request['status']); ?></td>
                            <td>
                                <a href="?controller=ride&action=book&ride_id=<?php echo $request['ride_id']; ?>" class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-info">No outgoing requests.</div>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>