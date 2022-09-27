<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Pattern;
use Illuminate\Http\Request;
use Session;

class PatternController extends Controller
{
    protected $patterns;
    protected $pattern;
    protected $patternId;
    protected $status;
    protected $patternData;

    public function index(){
        Session::flash('active', 'pattern');
        $this->patterns = Pattern::all();
        return view('admin.products_filter_pages.patterns', ['patterns' => $this->patterns]);
    }

    public function addEditPattern(Request $request, $id=null){
        if($id == ""){
            $title = 'Add Pattern';
        }else{
            $title= 'Edit Pattern';
            $this->patternData= Pattern::find($id);

            //update pattern post requst
           if($request->isMethod('post')){
                $this->validate($request, ['name' => 'required']);
                Pattern::updatePattern($request, $id);
                return redirect('/admin/patterns')->with('message', 'pattern Update Successfully');
           }
        }
            //pattern add post request
        if($request->isMethod('post')){
            $this->validate($request, ['name' => 'required']);
            Pattern::savePattern($request);
            return redirect()->back()->with('message', 'Pattern Save Successfully');
        }

        return view('admin.products_filter_pages.add-edit-pattern', ['title' => $title, 'patternData' => $this->patternData]);
    }

    public function updatePatternStatus(Request $request){
        Session::flash('active', 'pattern');
        if($request->ajax()){
            $this->pattern= Pattern::find($request->pattern_id);
            $this->patternId= $this->pattern->id;
            $this->status= $this->pattern->status;
            if($this->status == 1){
                $this->status= 0;
            }else{
                $this->status= 1;
            }

            Pattern::where('id', $this->patternId)->update(['status' => $this->status]);
            return response()->json(['status' => $this->status, 'pattern_id' => $this->patternId]);
        }

    }

    public function deletePattern($id){
        $pattern= Pattern::find($id);
        $pattern->delete();
        return redirect()->back()->with('message', 'Pattern Deleted Successfully');
    }
}
