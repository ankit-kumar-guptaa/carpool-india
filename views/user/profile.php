<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carpool India - Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
     <!-- Include Header -->
    <?php include 'views/partials/header.php'; ?>
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
    </nav> -->
    <div class="container mt-5">
        <h2>Your Profile</h2>
        <form method="POST" class="w-50">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Update Profile</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>