<?php

namespace App\Http\Controllers;

use App\Models\SsoToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * SSO Controller for Thiuu Ecosystem
 * 
 * Handles cross-app authentication between:
 * - KThiuu Hotel (this app)
 * - Thiuu CarRental
 */
class SsoController extends Controller
{
    private const APP_NAME = 'hotel';

    /**
     * Redirect to Thiuu CarRental with SSO token
     */
    public function redirectToCarRental(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('message', 'Vui lòng đăng nhập để tiếp tục');
        }

        $user = Auth::user();

        // Check app permission
        if (!$user->hasAppAccess('car_rental')) {
            return back()->with('error', 'Bạn không có quyền truy cập Thiuu CarRental');
        }

        // Generate SSO token
        $ssoToken = SsoToken::generateFor($user, self::APP_NAME, 'car_rental');

        // Redirect to CarRental app with token
        $carRentalUrl = config('services.ecosystem.car_rental_url', env('THIUU_CARRENTAL_URL', 'http://localhost:8000'));

        return redirect()->away($carRentalUrl . '/sso/callback?token=' . $ssoToken->token);
    }

    /**
     * Handle SSO callback from Thiuu CarRental
     */
    public function callback(Request $request)
    {
        $token = $request->query('token');

        if (!$token) {
            return redirect()->route('login')
                ->with('error', 'Token không hợp lệ');
        }

        // Find and validate token
        $ssoToken = SsoToken::findValid($token, self::APP_NAME);

        if (!$ssoToken) {
            return redirect()->route('login')
                ->with('error', 'Token đã hết hạn hoặc không hợp lệ');
        }

        // Mark token as used
        $ssoToken->markAsUsed();

        // Log in the user
        Auth::login($ssoToken->user, true);

        return redirect()->intended('/dashboard')
            ->with('success', 'Đăng nhập thành công từ Thiuu Ecosystem');
    }

    /**
     * Ecosystem portal page showing both services
     */
    public function portal()
    {
        return view('ecosystem.portal', [
            'carRentalUrl' => env('THIUU_CARRENTAL_URL', 'http://localhost:8000'),
            'hotelUrl' => env('KTHIUU_HOTEL_URL', 'http://localhost:8001'),
            'user' => Auth::user(),
        ]);
    }
}
