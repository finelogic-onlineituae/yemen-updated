<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thank You | Payment Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .thank-you-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
 
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .checkmark {
            font-size: 64px;
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="container thank-you-container">
        <div class="card text-center p-4">
            <div class="card-body">
                <div class="checkmark mb-3">
                    ✅
                </div>
                <h2 class="card-title">Thank You!</h2>
                <p class="card-text">Your payment was successful.</p>
                <p class="text-muted">Transaction ID: <strong>{{ request('chargeUID') }}</strong></p>
                <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go to Home</a>
            </div>
        </div>
    </div>
</body>
</html>
