<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','BATU grades')</title>
    <!-- Include Tailwind CSS styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body >
    <!-- Header -->
    <header class="text-white p-4" style="background-color: #1b4a4a">
        <div class="container mx-auto">
            {{-- <img src="logo.png" alt="logo" class="mr-2"> --}}
            <h1 class="text-2xl font-bold">Borg Al-Arab Technological University</h1>
        </div>
    </header>

    <!-- Content -->
    <div class="container mx-auto mt-16 p-4 max-w-md rounded shadow" style="background-color: #f5f6fa">
        <!-- Your content goes here -->
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="text-white p-4 mt-8" style="background-color: #1b4a4a">
        <div class="container mx-auto">
            <p>&copy; 2024 Borg Al-Arab Technological University - Developed by IT CLUB</p>
        </div>
    </footer>

</body>

</html>
