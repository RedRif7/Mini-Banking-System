<x-app-layout>
    <x-slot name="header" class="bg-[#233043]">
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
            <x-nav-link class="text-[#21324d]" href="/profile">Profile</x-nav-link>
            <x-nav-link class="text-[#21324d]" href="/profile/transactions">Transactions</x-nav-link>
            <x-nav-link class="text-[#21324d]" href="/profile/accounts">Accounts</x-nav-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="flex p-4 box-border container mx-auto flex space-x-4 text-[#233043]">
            <div class="w-1/2 border border-gray-300 shadow-xl rounded-lg bg-white">
                <h1 class="text-xl text-center font-bold py-6"><strong>Profile Information</strong></h1>
                <div class="p-8 text-lg">
                    <div><strong>Name - </strong> {{Auth::user()->name}} </div>
                    <div><strong>Email - </strong> {{Auth::user()->email}} </div>
                    <div><strong>Current IBAN - </strong> {{Auth::user()->iban}} </div>
                    <div><strong>Type - </strong> something... </div>
                </div>
            </div>
            <div class="w-1/2 border border-gray-300 shadow-xl rounded-lg bg-white">
                <h1 class="text-xl text-center font-bold py-6"><strong>Account Balance</strong></h1>
                <div class="p-6 text-lg text-center">
                    <div><strong>BALANCE</strong></div>
                    <div class="text-3xl"><strong>{{Auth::user()->currency}} {{number_format(Auth::user()->balance , 2) }}</strong></div>
                    <form action="{{ route('profile.updateBalance') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="mb-4 text-left">
                            <label class="block text-gray-700">Add Money:</label>
                            <input type="number" name="balance" min="0" step="0.01" required
                                   class="mt-1 block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="0.00">
                        </div>
                        <x-primary-button>
                            Save
                        </x-primary-button>
                    </form>
                </div>
            </div>
            <div class="w-1/2 border border-gray-300 shadow-xl rounded-lg bg-white">
                <div class="p-6 text-lg">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            <div class="w-1/2 border border-gray-300 shadow-xl rounded-lg bg-white">
                <div class="p-6 text-lg">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>
        <div class="container mx-auto flex mt-8 space-x-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
