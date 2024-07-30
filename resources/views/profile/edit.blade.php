<x-app-layout>
    <x-slot name="header" class="bg-[#233043]">
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
            <x-nav-link class="text-[#233043]" href="/profile">Profile</x-nav-link>
            <x-nav-link class="text-[#233043]" href="/profile/transactions">Transactions</x-nav-link>
            <x-nav-link class="text-[#233043]" href="/profile/accounts">Accounts</x-nav-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <h2 class="text-xl font-semibold mb-4">Balance</h2>
            <p class="text-2xl font-bold">{{$user->currency}} {{ number_format($user->balance, 2) }}</p>
            <form action="{{ route('profile.updateBalance') }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700">Add Money:</label>
                    <input type="number" name="balance" min="0" step="0.01" required
                           class="mt-1 block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="0.00">
                </div>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Save
                </button>
            </form>

        </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
