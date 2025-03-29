<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sistem Manajemen Cuti') }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#3490dc',
                        secondary: '#ffed4a',
                        danger: '#e3342f',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }
        .bubble {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            animation: float 8s ease-in-out infinite;
        }
        .bubble-1 {
            width: 200px;
            height: 200px;
            left: 10%;
            top: 30%;
            animation-delay: 0s;
        }
        .bubble-2 {
            width: 100px;
            height: 100px;
            left: 20%;
            top: 50%;
            animation-delay: 1s;
        }
        .bubble-3 {
            width: 150px;
            height: 150px;
            left: 15%;
            top: 15%;
            animation-delay: 2s;
        }
        .bubble-4 {
            width: 80px;
            height: 80px;
            left: 25%;
            top: 65%;
            animation-delay: 3s;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5), 
                        0 5px 15px rgba(0, 0, 0, 0.5), 
                        0 0 0 1px rgba(255, 255, 255, 0.1) inset;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6), 
                        0 10px 20px rgba(0, 0, 0, 0.6), 
                        0 0 0 1px rgba(255, 255, 255, 0.1) inset;
        }
        .login-button {
            background-color: #000;
            color: white;
            border-radius: 9999px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }
        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.4);
        }
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            border: 1px solid rgba(209, 213, 219, 0.5);
            background-color: rgba(255, 255, 255, 0.8);
            margin-top: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) inset;
        }
        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
            100% {
                transform: translateY(0px);
            }
        }
        .gradient-text {
            background: linear-gradient(90deg, #3490dc, #6574cd);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
            text-shadow: 0 2px 10px rgba(52, 144, 220, 0.3);
        }
        .bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.75);
            z-index: 1;
        }
    </style>
</head>
<body>
    <div class="relative min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url({{ asset('images/bg.jpeg') }});">
        <!-- Dark overlay -->
        <div class="bg-overlay"></div>
        
        <!-- Floating bubbles -->
        <div class="bubble bubble-1 z-10"></div>
        <div class="bubble bubble-2 z-10"></div>
        <div class="bubble bubble-3 z-10"></div>
        <div class="bubble bubble-4 z-10"></div>
        
        <!-- Login card -->
        <div class="login-card z-20">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold gradient-text">Leave Management</h1>
                <p class="text-gray-300 mt-2">Masuk ke akun Anda</p>
            </div>
            
            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-200">Email</label>
                    <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Alamat email Anda" />
                    @error('email')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-200">Kata Sandi</label>
                    <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" placeholder="Kata sandi Anda" />
                    @error('password')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex items-center justify-center">
                    <button type="submit" class="login-button">
                        Masuk
                    </button>
                </div>
            </form>
            
            <div class="mt-6 text-center text-sm text-gray-300">
                Butuh bantuan? Hubungi kami di <a href="mailto:support@leavemanagement.com" class="text-blue-300 hover:text-blue-200 hover:underline">support@leavemanagement.com</a>
            </div>
        </div>
    </div>
</body>
</html>
