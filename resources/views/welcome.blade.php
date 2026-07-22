<!DOCTYPE html>
<html>
<head>
    <title>Serenity Spa Booking System</title>

    <style>
        body{
            margin:0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg,#f5f7f2,#dff5ee);
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .card{
            width:700px;
            background:white;
            padding:50px;
            border-radius:25px;
            text-align:center;
            box-shadow:0 15px 35px rgba(0,0,0,0.1);
        }

        h1{
            color:#2c6e63;
            font-size:42px;
            margin-bottom:10px;
        }

        p{
            color:#666;
            font-size:18px;
        }

        .features{
            margin:30px 0;
            text-align:left;
        }

        .features li{
            margin:12px 0;
            font-size:17px;
        }

        .btn{
            display:inline-block;
            padding:15px 35px;
            background:#2c6e63;
            color:white;
            text-decoration:none;
            border-radius:12px;
            font-size:18px;
            transition:0.3s;
        }

        .btn:hover{
            background:#1f5048;
        }

        .footer{
            margin-top:30px;
            color:gray;
            font-size:14px;
        }
    </style>
</head>
<body>

<div class="card">

    <h1>🌿 Serenity Spa</h1>

    <p>Relax • Rejuvenate • Refresh</p>

    <hr>

    <p>
        Welcome to Serenity Spa Booking System.
        Experience luxury wellness and reserve your spa session with ease.
    </p>

    <div class="features">
        <ul>
            <li>💆 Premium Spa Services</li>
            <li>📅 Easy Booking Process</li>
            <li>📁 Secure Document Upload</li>
            <li>✅ Instant Booking Confirmation</li>
        </ul>
    </div>

    <a href="{{ route('bookings.create')  }}" class="btn">
        Start Booking
    </a>

    <div class="footer">
        © 2026 Serenity Spa Booking System
    </div>

</div>

</body>
</html>