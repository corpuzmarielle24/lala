<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\login_count;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    // public function redirectTo()
    // {

    //     $role = auth()->user()->role;
    //     switch ($role) {
    //         case '1':
    //             return '/admin/transaction/order';
    //             break;
    //         case '2':
    //             return '/member/transaction/order';
    //             break;
    //         default:
    //             return '/';
    //             break;
    //     }
    // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = url()->previous();
        $this->middleware('guest')->except('logout');

    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function getCredentials(Request $request)
    {
        return [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
    }
        public function login(Request $request) {
            $validator= $this->validate($request,['email' => 'required','password' => 'required']);

            if (Auth::guard()->attempt($this->getCredentials($request))){

                $user = User::where('email', $this->getCredentials($request)['email'])->firstOrFail();

                if($user){

                    if($user['is_approved']== 1){
                        // dd('here1'.$user );

                        $role = auth()->user()->role;
                        switch ($role) {
                            case '2':
                                return redirect('/admin/dashboard');
                                break;
                            case '1':
                                return redirect('/');
                                break;
                            case '0':
                                return redirect('/');
                                break;
                            default:
                                return '/';
                                break;
                        }
                    }else{
                        // dd('here2'.$user );
                        Auth::logout();

                        $request->session()->invalidate();

                        $request->session()->regenerateToken();
                        $request->session()->flash('message', 'Please wait for you account approval, check email for update!');
                        return redirect('/login');
                    }
                }

            }else{
                return redirect()->back()->withErrors(['email' => 'These credentials do not match our records.'])
                     ->withInput();
            }
        }
}
