<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Section;
use Illuminate\Http\Request;
use Session;

class SectionController extends Controller
{
    protected $sections;
    protected $sectionId;
    protected $status;

    public function index(){
        Session::flash('active', 'section');
        $this->sections = Section::all();
        return view('admin.section.section', ['sections' => $this->sections]);
    }

    public function updateSectionStatus(Request $request){
        Session::flash('active', 'section');
        if($request->ajax()){
            $this->sectionId= $request->section_id;
            $this->status= $request->status;
            if($this->status == 'Active'){
                $this->status= 0;
            }else{
                $this->status= 1;
            }

            Section::where('id', $this->sectionId)->update(['status' => $this->status]);
            return response()->json(['status' => $this->status, 'section_id' => $this->sectionId]);
        }

    }
}
