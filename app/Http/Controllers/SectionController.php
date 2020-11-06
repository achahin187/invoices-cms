<?php

namespace App\Http\Controllers;

use App\section;
use Illuminate\Foundation\Events\LocaleUpdated;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $sections=section::all();
        return view('sections.sections',compact('sections'));
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
        ////first check the section already exists or no 
        $input=$request->all();
        $exists=section::where('section_name','=',$input['section_name'])->exists();
        if($exists){
                 /////messages
        toastr()->error('هذا القسم موجود بالفعل');
        ///////////
        return redirect()->back();
        }
        
        //validation befor store
      $this->validate($request,[
'section_name' => 'required',
        ]);
        ///store sections

 $section=section::create([
'section_name' => $request->section_name,
'description' => $request->description,
        ]);
        /////messages
        toastr()->success('اتم اضافه القسم بنجاح');
        ///////////
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(section $section)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $id=$request->id;
    //validation befor supdate
    $this->validate($request,[
        'section_name' => 'required',
                ]);
          /////update
       $section=section::find($id);
         $section->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
         ]);
         
         //////alert

  toastr()->success('تم تعديل القسم بنجاح');
  /////return
        return redirect()->back();

      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         section::destroy($id);
        
        ////alert
        toastr()->success('تم مسح القسم بنجاح');
        return redirect()->back();

    }
}
