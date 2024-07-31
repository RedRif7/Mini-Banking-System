<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function index()
    {
        $user = Auth::user(); // Get the currently authenticated user
        $currencies = CurrenciesController::all(); // Fetch all available currencies

        return view('profile', [
            'user' => $user,
            'currencies' => $currencies,
        ]);
    }

    // Method to update balance
    public function updateBalance(Request $request)
    {
        $request->validate([
            'balance' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();
        $user->balance += $request->balance; // Add money to current balance
        $user->save();

        return redirect()->refresh()->with('success', 'Balance updated successfully.');
    }

    // Method to update currency
    public function updateCurrency(Request $request)
    {
        $request->validate([
            'currency' => 'required|string',
        ]);

        $user = Auth::user();
        $user->currency = $request->currency; // Update user's currency
        $user->save();

        return redirect()->refresh()->with('success', 'Currency updated successfully.');
    }
}
