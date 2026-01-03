<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Maintenance | Farm Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fcfdfc;
            color: #333;
        }
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&q=80&w=1600');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 80px 0;
            text-align: center;
        }
        .feature-card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
        .preview-container {
            position: relative;
            filter: blur(2px);
            pointer-events: none;
            user-select: none;
            opacity: 0.6;
        }
        .login-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            text-align: center;
            width: 100%;
        }
        .btn-farm {
            background-color: #2e7d32;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
        }
        .btn-farm:hover {
            background-color: #1b5e20;
            color: white;
        }
        .badge-due { background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; }
    </style>
</head>
<body>
  <?php include 'D:\Xampp\htdocs\farm\components\header.php'; ?>
  <?php include 'D:\Xampp\htdocs\farm\components\navbar.php'; ?>


<main class="container my-5">
    <div class="row text-center mb-5">
        <div class="col-md-4">
            <div class="card feature-card p-4">
                <h3>📅 Schedule</h3>
                <p class="text-muted">Set reminders for oil changes, tire rotations, and seasonal inspections.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card feature-card p-4">
                <h3>💰 Track Costs</h3>
                <p class="text-muted">Monitor your repair expenses to understand the ROI of your equipment.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card feature-card p-4">
                <h3>📱 Field Ready</h3>
                <p class="text-muted">Access your logs from your phone while you're out in the barn or field.</p>
            </div>
        </div>
    </div>

    <div class="position-relative">
        <div class="login-overlay">
            <div class="card p-4 shadow-lg d-inline-block" style="max-width: 400px; border-top: 5px solid #2e7d32;">
                <h4>Ready to start tracking?</h4>
                <p>Log in to view your equipment history and add new maintenance records.</p>
                <a href="login.php" class="btn btn-farm w-100">Sign In Now</a>
            </div>
        </div>

        <div class="preview-container">
            <h3 class="mb-4">Live Preview: Equipment Dashboard</h3>
            <div class="card p-4 border-0">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Equipment</th>
                            <th>Service Type</th>
                            <th>Cost</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Jan 12, 2024</td>
                            <td><strong>John Deere 5075E</strong></td>
                            <td>Hydraulic Fluid Flush</td>
                            <td>$450.00</td>
                            <td><span class="badge badge-due">Completed</span></td>
                        </tr>
                        <tr>
                            <td>Jan 05, 2024</td>
                            <td><strong>Pivot Irrigation B</strong></td>
                            <td>Motor Bearing Greasing</td>
                            <td>$85.00</td>
                            <td><span class="badge badge-due">Completed</span></td>
                        </tr>
                        <tr>
                            <td>Dec 20, 2023</td>
                            <td><strong>Massey Ferguson</strong></td>
                            <td>Battery Replacement</td>
                            <td>$180.00</td>
                            <td><span class="badge badge-due">Completed</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<footer class="text-center py-4 border-top">
    <p class="text-muted">&copy; 2024 Your Farm Website. All rights reserved.</p>
</footer>

</body>
</html>