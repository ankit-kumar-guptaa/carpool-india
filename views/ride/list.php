<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carpool India - Search Rides</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>
<body>
    <?php include '../views/partials/header.php'; ?>

    <div class="container mt-5">
        <h2 class="mb-4">Search Rides</h2>

        <!-- Search Form -->
        <form action="?controller=ride&action=search" method="POST" class="row g-3 mb-5">
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                    <input type="text" name="source" id="source" class="form-control" placeholder="From (e.g., Delhi)" value="<?php echo isset($_POST['source']) ? htmlspecialchars($_POST['source']) : ''; ?>" required>
                    <input type="hidden" name="source_lat" id="source_lat">
                    <input type="hidden" name="source_lon" id="source_lon">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                    <input type="text" name="destination" id="destination" class="form-control" placeholder="To (e.g., Mumbai)" value="<?php echo isset($_POST['destination']) ? htmlspecialchars($_POST['destination']) : ''; ?>" required>
                    <input type="hidden" name="dest_lat" id="dest_lat">
                    <input type="hidden" name="dest_lon" id="dest_lon">
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                    <input type="date" name="ride_date" class="form-control" value="<?php echo isset($_POST['ride_date']) ? htmlspecialchars($_POST['ride_date']) : date('Y-m-d'); ?>" required>
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> Search</button>
            </div>
        </form>

        <!-- Map Display -->
        <div class="col-12 mb-4">
            <div id="map" style="height: 400px;"></div>
        </div>

        <!-- Search Results -->
        <?php if (isset($rides)) { ?>
            <?php if (!empty($rides)) { ?>
                <h3 class="mb-3">Available Rides</h3>
                <div class="row">
                    <?php foreach ($rides as $ride) { ?>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($ride['source']); ?> <i class="fas fa-arrow-right"></i> <?php echo htmlspecialchars($ride['destination']); ?></h5>
                                    <p class="card-text">
                                        <strong><i class="fas fa-calendar-alt"></i> Date:</strong> <?php echo htmlspecialchars($ride['ride_date']); ?><br>
                                        <strong><i class="fas fa-clock"></i> Time:</strong> <?php echo htmlspecialchars($ride['ride_time']); ?><br>
                                        <strong><i class="fas fa-chair"></i> Seats Available:</strong> <?php echo htmlspecialchars($ride['seats_available']); ?><br>
                                        <strong><i class="fas fa-road"></i> Type:</strong> <?php echo htmlspecialchars($ride['ride_type']); ?>
                                    </p>
                                    <a href="?controller=ride&action=book&ride_id=<?php echo $ride['id']; ?>" class="btn btn-primary w-100">Book Now</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="alert alert-info text-center">No rides found. Try adjusting your search criteria!</div>
            <?php } ?>
        <?php } else { ?>
            <div class="alert alert-info text-center">Enter your travel details to search for rides.</div>
        <?php } ?>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- Custom Map JS -->
    <script src="../assets/js/map.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>