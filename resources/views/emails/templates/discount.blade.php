<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $campaign->subject ?? 'Endirim fürsəti!' }}</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9fafb; padding: 30px;">
<div style="background-color: #ffffff; border-radius: 10px; padding: 25px; max-width: 600px; margin: auto;">
    <h2 style="color: #16a34a;">Salam, {{ $user->name }} 🌿</h2>
    <p style="font-size: 15px; color: #4b5563;">
        Lorem impsum
    </p>

    <hr style="margin: 30px 0;">
    <p style="font-size: 12px; color: #9ca3af;">
        Bu mesaj avtomatik göndərilib. Əgər bu tip mesajlar almaq istəmirsinizsə,
        <a href="{{ $unsubscribe_url }}" style="color: #16a34a;">buradan ləğv edin</a>.
    </p>
</div>
</body>
</html>
