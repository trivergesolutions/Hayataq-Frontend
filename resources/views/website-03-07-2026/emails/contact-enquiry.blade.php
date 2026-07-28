<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Contact Enquiry</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; color: #333; line-height: 1.8;">

    <h2 style="margin-bottom: 20px;">New Contact Enquiry</h2>

    <p><strong>Department:</strong> {{ ucfirst(str_replace('_', ' ', $contact->department)) }}</p>

    <p><strong>Name:</strong> {{ $contact->user->name }}</p>

    <p><strong>Email:</strong> {{ $contact->user->email }}</p>

    <p><strong>Phone:</strong> {{ $contact->user->phone }}</p>

    <p><strong>Company:</strong> {{ $contact->company ?: '-' }}</p>

    <p><strong>Industry:</strong> {{ $contact->subject }}</p>

    <p>
        <strong>Message:</strong><br>
        {!! nl2br(e($contact->message)) !!}
    </p>

</body>

</html>
