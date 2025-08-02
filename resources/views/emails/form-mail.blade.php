<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Application PDF</title>
</head>
<body>
   <p>Dear {{ $application->applicant->name }},</p>
    <p>Thank you for your submission. Please find your attached application PDF below.</p>
    <p>Regards,<br>Your Team</p>
</body>
</html>
