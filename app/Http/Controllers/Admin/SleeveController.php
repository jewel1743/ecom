<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Sleeve;
use Illuminate\Http\Request;
use Session;

class SleeveController extends Controller
{
    protected $sleeves;
    protected $sleeve;
    protected $sleeveId;
    protected $status;
    protected $sleeveData;

    public function index(){
        Session::flash('active', 'sleeve');
        $this->sleeves = Sleeve::all();
        return view('admin.products_filter_pages.sleeves', ['sleeves' => $this->sleeves]);
    }

    public function addEditSleeve(Request $request, $id=null){
        Session::flash('active', 'sleeve');
        if($id == ""){
            $title = 'Add Sleeve';
        }else{
            $title= 'Edit Sleeve';
            $this->sleeveData= Sleeve::find($id);

            //update sleeve post requst
           if($request->isMethod('post')){
                $this->validate($request, ['name' => 'required']);
                Sleeve::updateSleeve($request, $id);
                return redirect('/admin/sleeves')->with('message', 'Sleeve Update Successfully');
           }
        }
            //sleeve add post request
        if($request->isMethod('post')){
            $this->validate($request, ['name' => 'required']);
            Sleeve::saveSleeve($request);
            return redirect()->back()->with('message', 'Sleeve Save Successfully');
        }

        return view('admin.products_filter_pages.add-edit-sleeve', ['title' => $title, 'sleeveData' => $this->sleeveData]);
    }

    public function updateSleeveStatus(Request $request){
        Session::flash('active', 'sleeve');
        if($request->ajax()){
            $this->sleeve= Sleeve::find($request->sleeve_id);
            $this->sleeveId= $this->sleeve->id;
            $this->status= $this->sleeve->status;
            if($this->status == 1){
                $this->status= 0;
            }else{
                $this->status= 1;
            }

            Sleeve::where('id', $this->sleeveId)->update(['status' => $this->status]);
            return response()->json(['status' => $this->status, 'sleeve_id' => $this->sleeveId]);
        }

    }

    public function deleteSleeve($id){
        Session::flash('active', 'sleeve');
        $sleeve= Sleeve::find($id);
        $sleeve->delete();
        return redirect()->back()->with('message', 'Sleeve Deleted Successfully');
    }
}
