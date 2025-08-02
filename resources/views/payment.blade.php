<!DOCTYPE html>
<html>
<head>
    <title>MamoPay Payment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card mx-auto shadow" style="max-width: 500px;">
        <div class="card-header text-center bg-primary text-white">
            <h4>Make a Payment</h4>
        </div>
        <div class="card-body text-center">
            <p class="mb-4">Click the button below to proceed with your payment via MamoPay.</p>

            <form action="{{ route('payment.start') }}" method="GET">
                <button type="submit" class="btn btn-success px-4 py-2">
                    Pay AED 1.00
                </button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
