<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DocumentPages;
use App\Document;
use App\UserDocumentRead;
use Auth;
use App\UserState;

class ReadPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $pages=DocumentPages::where('doc_id',$id)->get();
        $docName=Document::where('id',$id)->select('doc_name')->first()->doc_name;
        $docId = $id;

        return view('frontend.read.documents.pages.index',compact('pages','docName','docId'));
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
    public function show($did,$id)
    {



      $page=DocumentPages::where('id',$id)->first();

      if($page){

        return $page;

      }

      return $data=array(
                    'status'  =>"none",

                  );

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

    public function saveUserState(Request $request)
    {
      $document_read = UserDocumentRead::where('user_id',Auth::user()->id)
                                        ->where('document_id',$request->document_id)
                                        ->where('page_no',$request->page_no)->first();

       // $user_state= UserState::where('user_id',Auth::user()->id)-get()

      //   if($request->status=='attempted'){


      //   if($user_state == null)
      // {
      //   if(UserState::create(['user_id' => Auth::user()->id,'file_id'=>$request->document_id])
      //   {

      //   }
      // }
      // else {
      //   UserState::update(['page_no' => $request->page_no]);
      // }


      //   }



      if($document_read == null)
      {
        if(UserDocumentRead::create($request->all()))
        {

        }
      }
      else {
        if($document_read->status != 'attempted')
        {
          $document_read->update(['status' => $request->status]);
        }
      }
    }


    public function readStatus($user,$did,$id)
    {
       return $page=UserDocumentRead::where('page_no',$id)->where('document_id',$did)->where('user_id',$user)->select('status')->first()->status;
    }

    public function reviveUserState(Request $request)
    {
      $document_read = UserDocumentRead::where('user_id',Auth::user()->id)
                                        ->where('document_id',$request->doc_id)
                                        ->get();

      return $document_read;

    }

}
