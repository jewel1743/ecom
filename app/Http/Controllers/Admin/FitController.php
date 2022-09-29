<?php

namespace App\Http\Controllers\Admin;

use App\Fit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class FitController extends Controller
{
    protected $fits;
    protected $fit;
    protected $fitId;
    protected $status;
    protected $fitData;

    public function index(){
        Session::flash('active', 'fit');
        $this->fits = Fit::all();
        return view('admin.products_filter_pages.fits', ['fits' => $this->fits]);
    }

    public function addEditFit(Request $request, $id=null){
        Session::flash('active', 'fit');
        if($id == ""){
            $title = 'Add Fit';
        }else{
            $title= 'Edit Fit';
            $this->fitData= Fit::find($id);

            //update fit post requst
           if($request->isMethod('post')){
                $this->validate($request, ['name' => 'required']);
                Fit::updateFit($request, $id);
                return redirect('/admin/fits')->with('message', 'Fit Update Successfully');
           }
        }
            //fit add post request
        if($request->isMethod('post')){
            $this->validate($request, ['name' => 'required']);
            Fit::saveFit($request);
            return redirect()->back()->with('message', 'Fit Save Successfully');
        }

        return view('admin.products_filter_pages.add-edit-fit', ['title' => $title, 'fitData' => $this->fitData]);
    }

    public function updateFitStatus(Request $request){
        Session::flash('active', 'fit');
        if($request->ajax()){
            $this->fit= Fit::find($request->fit_id);
            $this->fitId= $this->fit->id;
            $this->status= $this->fit->status;
            if($this->status == 1){
                $this->status= 0;
            }else{
                $this->status= 1;
            }

            Fit::where('id', $this->fitId)->update(['status' => $this->status]);
            return response()->json(['status' => $this->status, 'fit_id' => $this->fitId]);
        }

    }

    public function deletefit($id){
        Session::flash('active', 'fit');
        $fit= Fit::find($id);
        $fit->delete();
        return redirect()->back()->with('message', 'Fit Deleted Successfully');
    }
}
