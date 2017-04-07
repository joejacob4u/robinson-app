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

                
        $data=DocumentPages::where('doc_id',$id)->get();

        return view('admin.documents.pages.index',compact('data','id'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function create($id)
    {
               

        return view('admin.documents.pages.create',compact('id')); 

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

                return redirect('admin/documents/'. $request->id.'/pages')->with('success','New Page has been added');
             }
             else
             {
                return redirect('admin/documents/'. $request->id.'/pages')->with('errors','Page Insertion Failed');
             }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($did,$id)
    {
        
        $data=DocumentPages::where('id',$id)->first(); 

        return view('admin.documents.pages.show',compact('data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($did,$id)
    {
        
     
        $data=DocumentPages::where('id',$id)->first(); 

        return view('admin.documents.pages.edit',compact('data','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($did,$id,Request $request)
    {
         $this->validate($request, [
                'doc_page_no' => 'required',
                'doc_page_content' => 'required',
               
                ]);
       

       //return $request->input();

        $data=array(
                    'doc_page_no'  =>$request->doc_page_no,
                    'doc_page_content'  =>$request->doc_page_content,
                    'tags'  =>$request->tags,
                   
                  );  

       //return $request->id;

        $result=DocumentPages::where('id',$id)->update($data);


             if($result)
             {
                return redirect('admin/documents/'. $did.'/pages')->with('success','Page Updated Successfully');
             }
             else
             {
                return redirect('admin/documents/'. $did.'/pages')->with('errors','Page Updation Failed');
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
                return redirect('admin/documents/'. $did.'/pages')->with('success','Page Deleted Successfully');
             }
             else
             {
                return redirect('admin/documents/'. $did.'/pages')->with('errors','Page Deletion Failed');
             
             }
    }
}
