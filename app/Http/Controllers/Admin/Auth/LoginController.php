<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Admin\ImpersonatingController;
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
        $this->redirectTo = route('admin.dashboard'); // Redirect to admin dashboard after login
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.admin.layout.signin'); // Return the login view
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
            'username' => 'required|string',
            'password' => 'required|min:5|max:30',
        ]);

        // Check if the user is already authenticated
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
        }

        // Check for too many login attempts
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        // Attempt to log the user in
        $credentials = $this->credentials($request);
        if (Auth::guard('admin')->attempt($credentials)) {
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

        // Handle impersonation stop if applicable
        (new ImpersonatingController())->stopImpersonate($request);

        return $this->loggedOut($request) ?: redirect()->route('admin.auth.login'); // Redirect after logout
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
            $field => $request->get($field), // Use the field name directly
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
        return $this->username(); // Return 'username' as the login field
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username'; // Specify that the login field is 'username'
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
