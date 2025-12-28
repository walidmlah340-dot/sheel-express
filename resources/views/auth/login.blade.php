<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>تسجيل الدخول | Sheel Express</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            background: #fff;
            padding: 30px;
            width: 350px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,.1);
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #1e40af;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>تسجيل الدخول</h2>

    <form method="POST" action="/login">
        @csrf

        <input 
            type="email" 
            name="email" 
            placeholder="البريد الإلكتروني"
            required
        >

        <button type="submit">دخول</button>
    </form>
</div>

</body>
</html>

