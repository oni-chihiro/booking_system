<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SPA Booking System</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>

<body style="margin:0;
background:#f5f7fa;
font-family:'Poppins',sans-serif;">

<div style="display:flex;
height:100vh;">

    <!-- LEFT SIDE -->

    <div style="
        width:50%;
        background:url('https://images.unsplash.com/photo-1519823551278-64ac92734fb1?auto=format&fit=crop&w=1400&q=80');
        background-size:cover;
        background-position:center;
        position:relative;">

        <div style="
            position:absolute;
            inset:0;
            background:rgba(32,79,71,.70);">

        </div>

        <div style="
            position:absolute;
            top:50%;
            left:50%;
            transform:translate(-50%,-50%);
            color:white;
            text-align:center;
            width:80%;">

            <h1 style="
            font-size:55px;
            font-weight:700;
            margin-bottom:15px;">
                SPA BOOKING
            </h1>

            <h3 style="
            font-weight:300;
            margin-bottom:30px;">
                Relax. Refresh. Rejuvenate.
            </h3>

            <p style="
            font-size:18px;
            line-height:32px;">
                Reserve your preferred schedule quickly and
                manage your bookings with our modern online
                booking platform.
            </p>

        </div>

    </div>

    <!-- RIGHT SIDE -->

    <div style="
        width:50%;
        display:flex;
        justify-content:center;
        align-items:center;
        background:#f5f7fa;">

        <div style="
            width:420px;
            background:white;
            padding:45px;
            border-radius:20px;
            box-shadow:0 20px 45px rgba(0,0,0,.10);">

            <div style="text-align:center;margin-bottom:35px;">

                <h2 style="
                color:#2c6e63;
                font-size:34px;
                margin-bottom:10px;">

                    Welcome Back

                </h2>

                <p style="color:#888;">
                    Login to your account
                </p>

            </div>

            {{ $slot }}

        </div>

    </div>

</div>

</body>
</html>