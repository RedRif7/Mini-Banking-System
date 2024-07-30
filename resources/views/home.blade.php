<x-app-layout>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ mix('css/app.css') }}" rel="stylesheet"> <!-- Ensure you have Tailwind CSS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!-- For AJAX -->
    </head>

    <body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Navigation</h2>
            <div class="flex flex-col space-y-4">
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link class="text-[#233043]" href="/profile">Profile</x-nav-link>
                    <x-nav-link class="text-[#233043]" href="/profile/transactions">Transactions</x-nav-link>
                    <x-nav-link class="text-[#233043]" href="/profile/accounts">Accounts</x-nav-link>
                </div>
            </div>
        </div>
        <!-- User Information Section -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h1 class="text-2xl font-semibold mb-4">Welcome, {{ $user->name }}!</h1>
            <div class="flex items-center space-x-4">
                <div class="flex-1">
                    <h2 class="text-lg font-medium">Balance</h2>
                    <p class="text-2xl font-bold">{{$user->currency}} {{ number_format($user->balance, 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Additional User Sections -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Account Details</h2>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Joined:</strong> {{ $user->created_at->format('M d, Y') }}</p>
        </div>

    </body>
    </html>


</x-app-layout>
