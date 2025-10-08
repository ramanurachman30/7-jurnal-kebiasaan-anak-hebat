<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Roles;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        // if (!$request->get('g-recaptcha-response')) return back()->withErrors('Captcha is not checked !');
        $request['status'] = 1;
        $request->authenticate();

        $request->session()->regenerate();
        $this->createToken();
        return redirect()->intended(RouteServiceProvider::HOME)->with("success", __('Wellcome back') . " " . Auth::user()->first_name . ' ' . Auth::user()->last_name);
    }

    public function createToken()
    {
        $user = Auth::user();
        $tokenResult = $user->createToken('Personal Access Token');

        $role = Roles::where('id', $user->role)->with('permission')->get()->toArray();

        $permissions = [];
        foreach ($role[0]['permission'] as $key => $items) {
            $permissions[] = $items['namespace'];
        }

        if (count($permissions) <= 0) $permissions[] = 'dashboard';

        $setPermisson = [
            'bearer_token' => $tokenResult->plainTextToken,
            'permissions' => $permissions
        ];

        // dd($setPermisson);

        session($setPermisson);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $user = auth()->user()->name;
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', __('Good bye') . ' ' . $user . ' ...');
    }
}
