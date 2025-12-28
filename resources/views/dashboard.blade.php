<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>Dashboard | Sheel Express</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        header {
            background: #2563eb;
            color: #fff;
            padding: 15px;
            text-align: center;
        }

        .container {
            padding: 30px;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,.1);
            margin-bottom: 20px;
        }

        button {
            padding: 10px 15px;
            background: #dc2626;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #991b1b;
        }
    </style>
</head>
<body>

<header>
    <h1>لوحة التحكم – Sheel Express</h1>
</header>

<div class="container">

    <div class="card">
        <h3>مرحبًا 👋</h3>
        <p>أنت مسجّل دخول بنجاح.</p>
    </div>

    <div class="card">
        <form method="POST" action="/logout">
            @csrf
            <button type="submit">تسجيل خروج</button>
        </form>
    </div>

</div>

</body>
</html>

