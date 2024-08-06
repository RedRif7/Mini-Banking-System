<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CurrenciesController;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $currencies = CurrenciesController::all();
        return view('auth.register',['currencies' => $currencies]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'currency' => ['required', 'string', 'size:3'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        $user = User::create([
            'name' => $request->name,
            'currency'=> $request->currency,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'balance' => 0.00,
            'iban' => RegisteredUserController::generateIban(),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home', absolute: false));
    }
    public static function generateIban()
    {
        $countryCode = 'LV';
        $bankCode = 'BANK';

        $randomNumbers = str_pad(mt_rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
        Log::info('Generated IBAN: ' . $randomNumbers);
        return $countryCode . '00' . $bankCode . $randomNumbers;
    }
}
