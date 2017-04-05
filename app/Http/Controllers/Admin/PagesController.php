<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DocumentPages;
use App\Document;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

      //  return DocumentPages::all()->document->doc_name;
                
        $data=DocumentPages::where('doc_id',$id)->get();



        return view('admin.pages',compact('data','id'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
               

        
        return view('admin.add_pages',compact('id'));

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
                'doc_page_no' => 'required',
                'doc_page_content' => 'required',
                
                ]);


       

        $data=array(
                    'doc_page_no'  =>$request->doc_page_no,
                    'doc_page_content'  =>$request->doc_page_content,
                    'doc_id'  =>$request->id,
                    'tags'  =>$request->tags,
                    
                   
                  );  

        

        $result=DocumentPages::create($data); 
      

        if($result)
             {
                \Session::flash('flash_message', 'Document Successfully Updated.');
                //return \Redirect::route('pages.index');
                 return redirect('admin/pages/list/'.$request->id);
             }
             else
             {
                 \Session::flash('flash_error_message', 'Document Updation Failed.');
              
                return redirect('admin/pages/list/'.$request->id);
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
        
        $data=DocumentPages::where('id',$id)->first(); 

        return view('admin.view_pages',compact('data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $data=DocumentPages::where('id',$id)->first(); 

        return view('admin.edit_pages',compact('data','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         $this->validate($request, [
                'doc_page_no' => 'required',
                'doc_page_content' => 'required',
               
                ]);
       

       

        $data=array(
                    'doc_page_no'  =>$request->doc_page_no,
                    'doc_page_content'  =>$request->doc_page_content,
                   
                  );  

       //return $request->id;

        $result=DocumentPages::where('id',$id)->update($data);


             if($result)
             {
                \Session::flash('flash_message', 'Page Successfully Updated.');
                return redirect('/admin/pages/list/'.$request->id);
             }
             else
             {
                 \Session::flash('flash_error_message', 'Page Updation Failed.');
                return redirect('/admin/pages/list/'.$request->id);
             }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($did,$id)
    {
       
         $result=DocumentPages::where('id',$id)->delete();

             if($result)
             { 
                \Session::flash('flash_message', 'Page Deleted Successfully.');
                return redirect('/admin/pages/list/'.$did);
             }
             else
             {
                 \Session::flash('flash_error_message', 'Page Deletion failed.');
                return redirect('/admin/pages/list/'.$did);
             }
    }
}
