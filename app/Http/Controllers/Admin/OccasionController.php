<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Occasion;
use Illuminate\Http\Request;
use Session;

class OccasionController extends Controller
{
    protected $occasions;
    protected $occasion;
    protected $occasionId;
    protected $status;
    protected $occasionData;

    public function index(){
        Session::flash('active', 'occasion');
        $this->occasions = Occasion::all();
        return view('admin.products_filter_pages.occasions', ['occasions' => $this->occasions]);
    }

    public function addEditoccasion(Request $request, $id=null){
        if($id == ""){
            $title = 'Add Occasion';
        }else{
            $title= 'Edit Occasion';
            $this->occasionData= Occasion::find($id);

            //update occasion post requst
           if($request->isMethod('post')){
                $this->validate($request, ['name' => 'required']);
                Occasion::updateOccasion($request, $id);
                return redirect('/admin/occasions')->with('message', 'Occasion Update Successfully');
           }
        }
            //occasion add post request
        if($request->isMethod('post')){
            $this->validate($request, ['name' => 'required']);
            Occasion::saveOccasion($request);
            return redirect()->back()->with('message', 'Occasion Save Successfully');
        }

        return view('admin.products_filter_pages.add-edit-occasion', ['title' => $title, 'occasionData' => $this->occasionData]);
    }

    public function updateoccasionStatus(Request $request){
        Session::flash('active', 'occasion');
        if($request->ajax()){
            $this->occasion= Occasion::find($request->occasion_id);
            $this->occasionId= $this->occasion->id;
            $this->status= $this->occasion->status;
            if($this->status == 1){
                $this->status= 0;
            }else{
                $this->status= 1;
            }

            Occasion::where('id', $this->occasionId)->update(['status' => $this->status]);
            return response()->json(['status' => $this->status, 'occasion_id' => $this->occasionId]);
        }

    }

    public function deleteOccasion($id){
        $occasion= Occasion::find($id);
        $occasion->delete();
        return redirect()->back()->with('message', 'Occasion Deleted Successfully');
    }
}
