<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PKMGrades;
use App\Models\PKMStudents;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $grades = PKMGrades::get();
        // dd($grades);
        return view('auth.register-murid', compact('grades'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'gender' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'grade_id' => ['required', 'integer', 'exists:p_k_m_grades,id'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'role' => '2',
            'password' => Hash::make($request->password),
        ]);

        PKMStudents::create([
            'student_name' => $request->name,
            'user_id' => $user->id,
            // Kalau ada input grade, pakai ini:
            'grade_id' => $request->grade_id,
            // Kalau tidak, biarkan null:
            // 'grade_id' => null,
        ]);
        // dd($user);

        event(new Registered($user));

        // Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME)->with("success", __('Kamu Berhasil Registrasi') . " " . Auth::user()->name);
    }
}
