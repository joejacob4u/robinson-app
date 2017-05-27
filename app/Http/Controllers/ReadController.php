<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\UserDocumentRead;
use App\DocumentPages;

class ReadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        $documents=Document::all();

        return view('frontend.read.index',compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function userState()
    {

    $docVal=UserDocumentRead::where('user_id',\Auth::User()->id)->where('status','attempted')->orderBy('updated_at','desc')->first();
        if($docVal)
        {
          
        $next=DocumentPages::where('doc_id',$docVal->document_id)->where('doc_page_no',$docVal->page_no+1)->first();

        $pages=DocumentPages::where('doc_id',$docVal->document_id)->get();
        $docName=Document::where('id',$docVal->document_id)->select('doc_name')->first()->doc_name;


        if($next){



        return view('frontend.read.documents.pages.index',compact('pages','docName','next'));
        
        }


        }


        
        else{

        return redirect('/read');
        }



    }
}
