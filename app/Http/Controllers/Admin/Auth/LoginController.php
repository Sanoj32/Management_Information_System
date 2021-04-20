<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    /**
     * Only guests for "admin" guard are allowed except
     * for logout.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    /**
     * Show the login form.
     *
     *
     */
    public function showLoginForm()
    {
        return view('auth.login', [
            'title'               => 'Admin Login',
            'loginRoute'          => 'admin.login',
            'forgotPasswordRoute' => 'admin.password.request',
        ]);
    }

    /**
     * Login the admin.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        //Validation...
        $this->validator($request);
        //check if the user has too many login attempts.
        if ($this->hasTooManyLoginAttempts($request)) {
            //Fire the lockout event.
            $this->fireLockoutEvent($request);

            //redirect the user back after lockout.
            return $this->sendLockoutResponse($request);
        }

        //Login the admin...
        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            // Authentication passed
            return redirect()
                ->intended(route('admin.home'))
                ->with('status', "You are logged in as an Admin!");
        }

        //keep track of login attempts from the user.
        $this->incrementLoginAttempts($request);

        //Authentication failed
        return $this->loginFailed();

        //Redirect the admin...
    }

    /**
     * Logout the admin.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        //logout the admin...
        Auth::guard('admin')->logout();
        
        return redirect()
            ->route('admin.login')
            ->with('status', 'Admin has been logged out!');
    }

    /**
     * Validate the form data.
     *
     * @param \Illuminate\Http\Request $request
     * @return
     */
    private function validator(Request $request)
    {
        //validation rules.
        $rules = [
            'email'    => 'required|email|exists:admins|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];

        //custom validation error messages.
        $messages = [
            'email.exists' => 'These credentials do not match our records.',
        ];

        //validate the request.
        $request->validate($rules, $messages);
    }

    /**
     * Redirect back after a failed login.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function loginFailed()
    {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Login failed, please try again!');
    }

    /**
     * This trait has all the login throttling functionality.
     */
    use ThrottlesLogins;

    //Your other code here...

    /**
     * Username used in ThrottlesLogins trait
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }
}
