<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carpool India - Create Ride</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>
<body>
    <?php include 'views/partials/header.php'; ?>

    <div class="container mt-5">
        <h2>Create a Ride</h2>

        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php } ?>

        <form action="?controller=ride&action=create" method="POST" class="row g-3">
            <!-- Source Input with Autocomplete -->
            <div class="col-md-6">
                <label for="source" class="form-label">From</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                    <input type="text" name="source" id="source" class="form-control" placeholder="Enter source (e.g., Delhi)" required>
                    <input type="hidden" name="source_lat" id="source_lat">
                    <input type="hidden" name="source_lon" id="source_lon">
                </div>
            </div>

            <!-- Destination Input with Autocomplete -->
            <div class="col-md-6">
                <label for="destination" class="form-label">To</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                    <input type="text" name="destination" id="destination" class="form-control" placeholder="Enter destination (e.g., Mumbai)" required>
                    <input type="hidden" name="dest_lat" id="dest_lat">
                    <input type="hidden" name="dest_lon" id="dest_lon">
                </div>
            </div>

            <!-- Map Display -->
            <div class="col-12">
                <div id="map" style="height: 400px;"></div>
            </div>

            <div class="col-md-3">
                <label for="ride_date" class="form-label">Date</label>
                <input type="date" name="ride_date" id="ride_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
            </div>

            <div class="col-md-3">
                <label for="ride_time" class="form-label">Time</label>
                <input type="time" name="ride_time" id="ride_time" class="form-control" required>
            </div>

            <div class="col-md-3">
                <label for="seats_available" class="form-label">Seats Available</label>
                <input type="number" name="seats_available" id="seats_available" class="form-control" min="1" required>
            </div>

            <div class="col-md-3">
                <label for="ride_type" class="form-label">Ride Type</label>
                <select name="ride_type" id="ride_type" class="form-control" required>
                    <option value="one-time">One-Time</option>
                    <option value="daily">Daily</option>
                </select>
            </div>

            <div class="col-12">
                <label for="comment" class="form-label">Comment (Optional)</label>
                <textarea name="comment" id="comment" class="form-control" rows="3" placeholder="Any additional details..."></textarea>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary w-100">Submit Ride</button>
            </div>
        </form>

        <a href="?controller=user&action=my_rides" class="btn btn-secondary mt-3">Back to My Rides</a>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- Custom Map JS -->
    <script src="assets/js/map.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>