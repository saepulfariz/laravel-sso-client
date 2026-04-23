<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client 1 - Dashboard</title>

    {{-- Assets — Bootstrap,Alpine,Tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100">

    <div class="min-h-screen flex flex-col items-center justify-center p-4">
        <div class="w-full max-w-2xl bg-white p-8 rounded-xl shadow-lg">

            <h1 class="text-2xl font-bold mb-6">Dashboard Client 1</h1>

            {{-- USER INFO --}}
            <div class="mb-8 p-4 bg-blue-50 border rounded-lg">
                <h3 class="font-bold mb-2 text-blue-800">User Info (from SSO)</h3>
                <p><strong class="text-gray-600">Email:</strong> <span
                        class="text-blue-600">{{ $user['email'] ?? 'N/A' }}
                    </span>
                </p>
                <p><strong class="text-gray-600">Name:</strong> <span class="text-blue-600">{{ $user['name'] ?? 'N/A'
                        }} </span>
                </p>
            </div>

            {{-- BUTTON LOGOUT --}}
            {{-- <form action="{{ route('sso.logout') }}" method="POST">
                @csrf
                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow-sm"
                    type="submit">Logout</button>
            </form> --}}

        </div>
    </div>

</body>

</html>