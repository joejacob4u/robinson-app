<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Document;
use File;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

       $data=Document::all();

       return view('admin.documents.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

       
        $categories =Category::pluck('cat_name', 'id');


        return view('admin.documents.create',compact('categories'));




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
                'doc_name' => 'required|unique:tbl_document',
                'doc_author' => 'required',
                'publish_date' => 'required',
                'category' => 'required',
                ]);

         $date = date('Y-m-d', strtotime($request->publish_date));
       


        if($request->doc_cover)
        { 
        $imageName = $request->doc_name.'.'.$request->doc_cover->getClientOriginalExtension();
        $request->doc_cover->move(public_path('files/documents/cover'), $imageName);
        }
        else{

          $imageName='default.png'; 

        }

        $data=array(
                    'doc_name'  =>$request->doc_name,
                    'doc_author'  =>$request->doc_author,
                    'publish_date'  =>$date,
                    'cat_id'  =>$request->category,
                    'doc_cover'  =>$imageName,
                   
                  );  

        $result=Document::create($data); 
      

        if($result)
             {
                return redirect('admin/documents')->with('success','New Document has been added');
             }
             else
             {
                return redirect('admin/documents')->with('errors','Document Insertion Failed');
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
        //



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data=Document::where('id',$id)->first(); 
        $categories =Category::pluck('cat_name', 'id');

        return view('admin.documents.edit',compact('data','categories'));
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
        //
        $document = new Document;

        $this->validate($request, [
                'doc_name' => 'required',
                'doc_author' => 'required',
                'publish_date' => 'required',
                'category' => 'required',
                ]);

         $date = date('Y-m-d', strtotime($request->publish_date));
        if($request->doc_cover)
        {
             $image=$document->select('doc_cover')->where('id',$id)->first()->doc_cover;
             File::delete('/files/documents/cover/'.$image); 
             $imageName = $request->doc_name.'.'.$request->doc_cover->getClientOriginalExtension();
             $request->doc_cover->move(public_path('files/documents/cover'), $imageName);

        }
        else{

             $imageName=$document->select('doc_cover')->where('id',$id)->first()->doc_cover;

        }

       

        $data=array(
                    'doc_name'  =>$request->doc_name,
                    'doc_author'  =>$request->doc_author,
                    'publish_date'  =>$date,
                    'cat_id'  =>$request->category,
                    'doc_cover'  =>$imageName,
                   
                  );  

        $result=Document::where('id',$id)->update($data);


             if($result)
             {
                return redirect('admin/documents')->with('success','Document Successfully Updated');
             }
             else
             {

                return redirect('admin/documents')->with('errors','Document Updation Failed');

             }
      

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
         $image=Document::select('doc_cover')->where('id',$id)->first()->doc_cover;
         $result=Document::where('id',$id)->delete();

             if($result)
             {
               
                File::delete('/files/documents/cover/'.$image); 

                return redirect('admin/documents')->with('success','Document Deleted Successfully');
             }
             else
             {
                 return redirect('admin/documents')->with('errors','Document Deletion Failed');
             }
    }
}
