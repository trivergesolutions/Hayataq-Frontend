<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Product Enquiry</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; color:#333; line-height:1.8;">

    <h2>New Product Enquiry</h2>

    <p><strong>Name:</strong> {{ $enquiry->user->name }}</p>

    <p><strong>Email:</strong> {{ $enquiry->user->email }}</p>

    <p><strong>Business Name:</strong> {{ $enquiry->comapny }}</p>

    <p><strong>Phone:</strong> {{ $enquiry->user->phone ?: '-' }}</p>

    @if ($enquiry->product)
        <p><strong>Product:</strong> {{ $enquiry->product->name }}</p>
    @endif

    @if ($enquiry->accessory)
        <p><strong>Accessory:</strong> {{ $enquiry->accessory->name }}</p>
    @endif

    <p>
        <strong>Message:</strong><br>
        {!! nl2br(e($enquiry->message)) !!}
    </p>

</body>

</html>
