<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carpool India - Rides</title>
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
        <h2>Rides</h2>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>
        <div class="row">
            <div class="col-md-6">
                <h3>Create a Ride</h3>
                <form method="POST" action="?controller=ride&action=create">
                    <div class="mb-3">
                        <label for="source" class="form-label">From</label>
                        <input type="text" name="source" id="source" class="form-control" placeholder="Enter a location" required>
                    </div>
                    <div class="mb-3">
                        <label for="destination" class="form-label">To</label>
                        <input type="text" name="destination" id="destination" class="form-control" placeholder="Enter a location" required>
                    </div>
                    <div class="mb-3">
                        <label for="ride_date" class="form-label">Date</label>
                        <input type="date" name="ride_date" id="ride_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="ride_time" class="form-label">Time</label>
                        <input type="time" name="ride_time" id="ride_time" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="seats_available" class="form-label">Seats Available</label>
                        <input type="number" name="seats_available" id="seats_available" class="form-control" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="ride_type" class="form-label">Ride Type</label>
                        <select name="ride_type" id="ride_type" class="form-control" required>
                            <option value="one-way">One Way</option>
                            <option value="round-trip">Round Trip</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea name="comment" id="comment" class="form-control" placeholder="I am looking for carpool"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Submit</button>
                </form>
            </div>
            <div class="col-md-6">
                <h3>Search Rides</h3>
                <form method="POST" action="?controller=ride&action=search">
                    <div class="mb-3">
                        <label for="search_source" class="form-label">From</label>
                        <input type="text" name="source" id="search_source" class="form-control" placeholder="Enter a location" required>
                    </div>
                    <div class="mb-3">
                        <label for="search_destination" class="form-label">To</label>
                        <input type="text" name="destination" id="search_destination" class="form-control" placeholder="Enter a location" required>
                    </div>
                    <div class="mb-3">
                        <label for="search_ride_date" class="form-label">Date</label>
                        <input type="date" name="ride_date" id="search_ride_date" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </form>
                <?php if (isset($rides) && !empty($rides)) { ?>
                    <h4 class="mt-4">Available Rides</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Source</th>
                                <th>Destination</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Seats</th>
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
                                        <a href="?controller=ride&action=book&ride_id=<?php echo $ride['id']; ?>" class="btn btn-primary btn-sm">Book</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } elseif (isset($rides)) { ?>
                    <div class="alert alert-info mt-4">No rides found.</div>
                <?php } ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>