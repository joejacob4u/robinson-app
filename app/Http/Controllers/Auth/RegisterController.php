<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
   // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
          $messages = [
            'emailid.unique' => 'The email has already been taken.',
            ];


        return Validator::make($data, [
            'name' => 'required|max:255',
            'emailid' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ],$messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        $student=Student::where('email',$data['emailid'])->first();

        if($student)
        {

            if($data['emailid']==$student->email)
            {
                return User::create([
                'name' => $data['name'],
                'email' => $data['emailid'],
                'password' => bcrypt($data['password']),
                'parent_id' => $student->parent_id,
                'type' => 'Student',
            ]);

                
            }
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['emailid'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function authenticated($request, $user)
    {
        if($user->type==="Admin") {
            return redirect()->intended('/admin');
        }
        return redirect()->intended('/');
    }

   
}
