<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carpool India - Verify OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

 <!-- Include Header -->
    <?php include '../views/partials/header.php'; ?>
    
    <div class="container mt-5">
        <h2 class="text-center">Verify OTP</h2>
        <p>An OTP has been sent to your email. Please enter it below.</p>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>
        <form method="POST" class="w-50 mx-auto">
            <div class="mb-3">
                <label for="otp" class="form-label">OTP</label>
                <input type="text" name="otp" id="otp" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Verify</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>