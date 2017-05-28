<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\UserDocumentRead;
use App\DocumentPages;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    
    protected function authenticated(Request $request, $user)
    {
        if(\Auth::user()->type=='Teacher'){

            return redirect('/teacher');
        }

        if(\Auth::user()->type=='Parent'){

            return redirect('/parent');
        }


        if(\Auth::user()->type=='Student'){



        $docVal=UserDocumentRead::where('user_id',\Auth::User()->id)->where('status','attempted')->orderBy('updated_at','desc')->first();


        if($docVal)
        {
          
       $next=DocumentPages::where('doc_id',$docVal->document_id)->where('doc_page_no',$docVal->page_no+1)->first();


       return redirect('/read/document-'.$docVal->document_id.'/pages');

        
        }
        else{


            return redirect('/read');
        }

    }
    }


}
