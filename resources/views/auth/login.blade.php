<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>

    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: linear-gradient(to bottom right, #E5EAEE, #C9D4DD);
            background-size: cover;
        }
    </style>
</head>

<body class="min-h-screen flex justify-center items-center">

    <div class="bg-white/80 backdrop-blur-md p-10 rounded-2xl shadow-xl w-full max-w-md">

        <!-- Logo -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-[#0A3A5C]">Admin Login</h1>
            <p class="text-gray-600">Welcome back, please login to continue</p>
        </div>

        <!-- Errors -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{route('admin.login.submit')}}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <label class="block mb-1 font-semibold text-[#0A3A5C]">Email</label>
                <input type="email" name="username" required
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5FA7D4]">
            </div>

            <!-- Password -->
            <div>
                <label class="block mb-1 font-semibold text-[#0A3A5C]">Password</label>
                <input type="password" name="password" required
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5FA7D4]">
            </div>

            <!-- Login Button -->
            <button type="submit"
                    class="w-full py-3 bg-[#0A3A5C] text-white rounded-lg text-lg font-semibold hover:bg-[#082d47] transition">
                Login
            </button>

        </form>

      
    </div>

</body>
</html>
