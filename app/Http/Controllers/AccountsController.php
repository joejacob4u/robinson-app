<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MailStudent;
use App\User;
use App\Student;

class AccountsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->type=='User')
        {
            return redirect('/');
        }

        $id=\Auth::user()->id;
        $students=User::where('parent_id',$id)->paginate(10);
        return view('frontend.accounts.parent.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.accounts.parent.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $this->validate($request, [
                'email' => 'required|email|max:255|unique:students,email',
                ]);
         


        try{

        $result=Student::create([
            'email' => $request->email,
            'parent_id'=>\Auth::user()->id,
        ]); 


         \Mail::to($request->email)->send(new MailStudent);

         if($result)
             {
                return redirect('accounts')->with('success','New Student has been added');
             }
             else
             {
                return redirect('accounts')->with('errors','Student Insertion Failed');
             }


        }catch(\Exception $e){
        
          return $e;
      }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student=User::where('id',$id)->first();

        return $student;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student=User::where('id',$id)->first();

        return $student;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //return $request->edit_id;
        $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                ]);

            //return $edit_id=request->input()->'edit_id'];
           $eid= User::where('email',$request->email)->first();


           if($eid)
           {



           if($eid->id!=$request->edit_id)
           {
                //return "already used";
                 $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                ]);

           }


           }

        
        try{     


        $data=array(
                    'name'  =>$request->name,
                    'email'  =>$request->email,
                    'password'  =>bcrypt($request->password),               
                  );  

        $result=User::where('id',$request->edit_id)->update($data);


             if($result)
             {
                return redirect('accounts')->with('success','Student Successfully Updated');
             }
             else
             {

                return redirect('accounts')->with('errors','Student Updation Failed');

             }

     }catch(\Exception $e){
   return $e;
            
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $input=$request->input();

        $del_id= $input['delete_id'];
     
        try{
         $result=User::where('id',$del_id)->delete();

             if($result)
             {
                           
                return redirect('accounts')->with('success','Successfully Deleted Successfully');
             }
             else 
             {
                 return redirect('accounts')->with('errors','Student Deletion Failed');
             }

        }catch(\Exception $e){
 
            return redirect('accounts')->with('errors','Student Deletion Failed,Delete all sub Pages before deleting this Document ');
      }
    }


    public function userType($id)
    {

        if($id==0)
        {
            $result=User::where('id',\Auth::user()->id)->update(['type'=>'Student']);


            return redirect('/')->with('success','Successfully Deleted Successfully');

        }
        
        if($id==1)
        {

            $result=User::where('id',\Auth::user()->id)->update(['type'=>'Parent']);
            return redirect('/accounts');

        }

        
    }
}
