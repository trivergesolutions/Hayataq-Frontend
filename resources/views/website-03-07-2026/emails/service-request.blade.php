<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Service Request</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; color: #333; line-height: 1.8;">

    <h2 style="margin-bottom: 20px;">New Service Request</h2>

    <p><strong>Name:</strong> {{ $service->user->name }}</p>

    <p><strong>Email:</strong> {{ $service->user->email }}</p>

    <p><strong>Phone:</strong> {{ $service->user->phone }}</p>

    <p><strong>Service:</strong> {{ $service->service }}</p>

    <p>
        <strong>Requirements:</strong><br>
        {!! nl2br(e($service->requirements)) !!}
    </p>

</body>

</html>
