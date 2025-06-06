<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool India - Ride Sharing Made Easy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        :root {
            --saffron: #FF9933;
            --white: #FFFFFF;
            --green: #138808;
            --navy-blue: #000080;
            --light-blue: #E6F2FF;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('https://images.unsplash.com/photo-1583121274602-3e2820c69888?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            padding: 150px 0 100px;
            color: white;
            text-align: center;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
        }
        
        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 40px;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
        }
        
        .hero-btn {
            padding: 12px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            margin: 0 10px;
            transition: all 0.3s;
        }
        
        .btn-search {
            background-color: var(--saffron);
            border: none;
            color: white;
        }
        
        .btn-search:hover {
            background-color: #e68a00;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .btn-join {
            background-color: transparent;
            border: 2px solid white;
            color: white;
        }
        
        .btn-join:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-3px);
        }
        
        /* Ads Container */
        .ad-container {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin: 20px 0;
            text-align: center;
            min-height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Rides Section */
        .rides-section {
            padding: 60px 0;
            background-color: white;
        }
        
        .section-title {
            font-weight: 700;
            color: var(--navy-blue);
            margin-bottom: 40px;
            position: relative;
            text-align: center;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, var(--saffron), var(--green));
            border-radius: 2px;
        }
        
        .ride-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            margin-bottom: 20px;
        }
        
        .ride-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .ride-card .card-img-top {
            height: 150px;
            object-fit: cover;
        }
        
        .ride-card .card-title {
            color: var(--navy-blue);
            font-weight: 600;
        }
        
        .ride-card .fa-arrow-right {
            color: var(--saffron);
        }
        
        .ride-card .price {
            color: var(--green);
            font-weight: 700;
            font-size: 1.2rem;
        }
        
        .ride-card .btn-book {
            background-color: var(--green);
            border: none;
            width: 100%;
        }
        
        .ride-card .btn-book:hover {
            background-color: #0e6e06;
        }
        
        /* Features Section */
        .features-section {
            padding: 60px 0;
            background-color: var(--light-blue);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 20px;
            background: linear-gradient(45deg, var(--saffron), var(--green));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        /* Footer */
        footer {
            background-color: var(--navy-blue);
            color: white;
            padding: 40px 0 20px;
        }
        
        .social-icons a {
            color: white;
            font-size: 1.2rem;
            margin: 0 10px;
            transition: all 0.3s;
        }
        
        .social-icons a:hover {
            color: var(--saffron);
            transform: translateY(-3px);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
            
            .hero-btn {
                display: block;
                width: 80%;
                margin: 10px auto;
            }
        }
    </style>
</head>
<body>
    <!-- Include Header -->
    <?php include '../views/partials/header.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title animate__animated animate__fadeInDown">Share Rides Across India</h1>
            <p class="hero-subtitle animate__animated animate__fadeInUp">Save money, reduce traffic, and travel sustainably</p>
            
            <div class="animate__animated animate__zoomIn animate__delay-1s">
                <a href="?controller=ride&action=search" class="hero-btn btn-search"><i class="fas fa-search me-2"></i> Search Rides</a>
                <a href="?controller=auth&action=signup" class="hero-btn btn-join"><i class="fas fa-user-plus me-2"></i> Join Us</a>
            </div>
        </div>
    </section>

    <!-- Google Ads Container -->
    <div class="container mt-4">
        <div class="ad-container">
            <!-- Google Ads will be placed here -->
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-XXXXXXXXXXXXXXXX"
                    crossorigin="anonymous"></script>
            <!-- Homepage Leaderboard -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-XXXXXXXXXXXXXXXX"
                 data-ad-slot="XXXXXXXXXX"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
            <script>
                 (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>

    <!-- Popular Rides Section -->
    <section class="rides-section">
        <div class="container">
            <h2 class="section-title">Available Rides Near You</h2>
            
            <!-- Google Ads Container -->
            <div class="ad-container mb-5">
                <!-- Google Ads will be placed here -->
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-XXXXXXXXXXXXXXXX"
                        crossorigin="anonymous"></script>
                <!-- Homepage Rectangle -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-XXXXXXXXXXXXXXXX"
                     data-ad-slot="XXXXXXXXXX"
                     data-ad-format="auto"
                     data-full-width-responsive="true"></ins>
                <script>
                     (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
            
            <div class="row">
                <!-- Ride 1 -->
                <div class="col-md-4">
                    <div class="card ride-card">
                        <img src="https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Car Image">
                        <div class="card-body">
                            <h5 class="card-title">Delhi <i class="fas fa-arrow-right"></i> Jaipur</h5>
                            <p class="card-text">
                                <i class="fas fa-calendar-alt text-primary"></i> <strong>Date:</strong> 15 June 2025<br>
                                <i class="fas fa-clock text-primary"></i> <strong>Time:</strong> 07:30 AM<br>
                                <i class="fas fa-chair text-primary"></i> <strong>Seats:</strong> 2 available<br>
                                <i class="fas fa-car text-primary"></i> <strong>Vehicle:</strong> Hyundai Creta
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price">₹350/seat</span>
                                <button class="btn btn-success btn-book" data-bs-toggle="modal" data-bs-target="#bookingModal">
                                    <i class="fas fa-ticket-alt me-1"></i> Book Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Ride 2 -->
                <div class="col-md-4">
                    <div class="card ride-card">
                        <img src="https://images.unsplash.com/photo-1547036967-23d11aacaee0?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Car Image">
                        <div class="card-body">
                            <h5 class="card-title">Mumbai <i class="fas fa-arrow-right"></i> Pune</h5>
                            <p class="card-text">
                                <i class="fas fa-calendar-alt text-primary"></i> <strong>Date:</strong> 16 June 2025<br>
                                <i class="fas fa-clock text-primary"></i> <strong>Time:</strong> 06:00 AM<br>
                                <i class="fas fa-chair text-primary"></i> <strong>Seats:</strong> 3 available<br>
                                <i class="fas fa-car text-primary"></i> <strong>Vehicle:</strong> Maruti Swift
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price">₹250/seat</span>
                                <button class="btn btn-success btn-book" data-bs-toggle="modal" data-bs-target="#bookingModal">
                                    <i class="fas fa-ticket-alt me-1"></i> Book Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Ride 3 -->
                <div class="col-md-4">
                    <div class="card ride-card">
                        <img src="https://images.unsplash.com/photo-1550355291-bbee04a92027?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Car Image">
                        <div class="card-body">
                            <h5 class="card-title">Bangalore <i class="fas fa-arrow-right"></i> Chennai</h5>
                            <p class="card-text">
                                <i class="fas fa-calendar-alt text-primary"></i> <strong>Date:</strong> 18 June 2025<br>
                                <i class="fas fa-clock text-primary"></i> <strong>Time:</strong> 05:30 AM<br>
                                <i class="fas fa-chair text-primary"></i> <strong>Seats:</strong> 1 available<br>
                                <i class="fas fa-car text-primary"></i> <strong>Vehicle:</strong> Toyota Innova
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price">₹500/seat</span>
                                <button class="btn btn-success btn-book" data-bs-toggle="modal" data-bs-target="#bookingModal">
                                    <i class="fas fa-ticket-alt me-1"></i> Book Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="?controller=ride&action=search" class="btn btn-outline-primary">View All Rides</a>
            </div>
        </div>
    </section>

    <!-- Google Ads Container -->
    <div class="container mt-4">
        <div class="ad-container">
            <!-- Google Ads will be placed here -->
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-XXXXXXXXXXXXXXXX"
                    crossorigin="anonymous"></script>
            <!-- Homepage Banner -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-XXXXXXXXXXXXXXXX"
                 data-ad-slot="XXXXXXXXXX"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
            <script>
                 (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>

    <!-- Key Features Section -->
    <section class="features-section">
        <div class="container">
            <h2 class="section-title">Why Carpool with Us?</h2>
            
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    <i class="fas fa-rupee-sign feature-icon"></i>
                    <h4>Save Up to 75%</h4>
                    <p>Share fuel costs and toll charges with fellow travelers.</p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <i class="fas fa-leaf feature-icon"></i>
                    <h4>Eco-Friendly</h4>
                    <p>Reduce carbon emissions by sharing your ride.</p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <i class="fas fa-shield-alt feature-icon"></i>
                    <h4>Verified Users</h4>
                    <p>All drivers and passengers are verified for your safety.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="bookingModalLabel">Confirm Your Booking</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle me-2"></i> 1 seat available for booking!
                    </div>
                    
                    <form id="bookingForm">
                        <div class="mb-3">
                            <label for="passengerName" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="passengerName" required>
                        </div>
                        <div class="mb-3">
                            <label for="passengerPhone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="passengerPhone" required>
                        </div>
                        <div class="mb-3">
                            <label for="pickupPoint" class="form-label">Pickup Point</label>
                            <input type="text" class="form-control" id="pickupPoint" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="agreeTerms" required>
                            <label class="form-check-label" for="agreeTerms">I agree to the terms and conditions</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="confirmBooking">
                        <i class="fas fa-check-circle me-1"></i> Confirm Booking
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Toast -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="bookingToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success text-white">
                <strong class="me-auto"><i class="fas fa-check-circle me-2"></i> Booking Confirmed</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Your ride has been successfully booked! Driver details have been sent to your phone.
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p>&copy; 2025 Carpool India. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Booking confirmation
        document.getElementById('confirmBooking').addEventListener('click', function() {
            // Validate form
            const form = document.getElementById('bookingForm');
            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }
            
            // Show success toast
            const toast = new bootstrap.Toast(document.getElementById('bookingToast'));
            toast.show();
            
            // Close modal after 1 second
            setTimeout(() => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('bookingModal'));
                modal.hide();
            }, 1000);
        });
        
        // Reset form when modal closes
        document.getElementById('bookingModal').addEventListener('hidden.bs.modal', function () {
            document.getElementById('bookingForm').reset();
            document.getElementById('bookingForm').classList.remove('was-validated');
        });
    </script>
</body>
</html>