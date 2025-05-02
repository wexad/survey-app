<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anketa yaratuvchi sayt</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="text-center mt-[-60px]">
    <h1 class="text-5xl font-extrabold text-gray-800 mb-10">Anketa so'rovnomalarini yaratuvchi veb saytga xush kelibsiz</h1>
    <div class="space-x-6">
        <a href="{{ route('login') }}"
           class="inline-block px-8 py-3 text-lg text-white bg-black rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black transition">
            Kirish
        </a>
        <a href="{{ route('register') }}"
           class="inline-block px-8 py-3 text-lg text-white bg-black rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black transition">
            Ro'yxatdan o'tish
        </a>
    </div>
</div>
</body>
</html>
