<!DOCTYPE html>
<html>

<head>
    <title>Thông tin đăng nhập</title>
</head>

<body>
    <p>Chào {{ $user->name }},</p>
    <p>Tài khoản của bạn đã được tạo thành công.</p>
    <ul>
        <li>Email: {{ $user->email }}</li>
        <li>Mật khẩu: {{ $password }}</li>
    </ul>
    <p>Bạn có thể đăng nhập tại: <a
            href="{{ config('app.url') . '/' . 'login' }}">{{ config('app.url') . '/' . 'login' }}</a></p>
    <p>Cảm ơn bạn!</p>
</body>

</html>
