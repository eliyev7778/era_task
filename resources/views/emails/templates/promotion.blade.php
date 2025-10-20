<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $campaign->subject ?? 'Lorem impsum' }}</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f3f4f6; padding: 30px;">
<div style="background-color: #ffffff; border-radius: 8px; padding: 20px; max-width: 600px; margin: auto;">
    <h2 style="color: #1f2937;">Salam, {{ $user->name }}!</h2>
    <p style="font-size: 16px; color: #374151;">
       Lorem impsum
    </p>
    <p style="font-size: 15px; color: #4b5563;">
        Lorem impsum
    </p>
    <hr style="margin: 30px 0;">
    <p style="font-size: 12px; color: #9ca3af;">
        Bu e-mail avtomatik göndərilib. Əgər belə mesajlar almaq istəmirsinizsə,
        <a href="{{ $unsubscribe_url }}" style="color: #2563eb;">buradan ləğv edin</a>.
    </p>
</div>
</body>
</html>
