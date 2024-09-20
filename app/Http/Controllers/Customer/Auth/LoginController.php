<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->redirectTo = route('customer.dashboard'); // Redirect to customer dashboard after login
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.customer.layout.signin'); // Return the login view
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validate the login request
        $request->validate([
            'login' => 'required|string', // Updated to a single field for login
            'password' => 'required|min:5|max:30',
        ]);

        // Check if the user is already authenticated
        if (Auth::guard('customer')->check()) {
            return redirect()->route('customer.dashboard')->with('success', 'Login successful!');
        }

        // Check for too many login attempts
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        // Attempt to log the user in with either username or email
        $credentials = $this->credentials($request);
        if (Auth::guard('customer')->attempt($credentials)) {
            $this->clearLoginAttempts($request); // Clear attempts on successful login
            return $this->sendLoginResponse($request);
        }

        // Increment login attempts on failure
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }


    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout(); // Log the user out
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token


        return $this->loggedOut($request) ?: redirect()->route('customer.auth.login'); // Redirect after logout
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $field = $this->field($request); // Determine the login field

        return [
            $field => $request->get('login'), // Use the single login field
            'password' => $request->get('password'), // Get the password
        ];
    }

    /**
     * Determine the login field (username).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function field(Request $request)
    {
        // Check if the input is an email
        return filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    }

    
    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => ['Data terkait tidak cocok dengan data yang kami miliki.'], // Custom error message
        ]);
    }
}
