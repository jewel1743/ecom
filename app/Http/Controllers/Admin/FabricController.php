<?php

namespace App\Http\Controllers\Admin;

use App\Fabric;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class FabricController extends Controller
{
    protected $fabrics;
    protected $fabric;
    protected $fabricId;
    protected $status;
    protected $fabricData;

    public function index(){
        Session::flash('active', 'fabric');
        $this->fabrics = Fabric::all();
        return view('admin.products_filter_pages.fabrics', ['fabrics' => $this->fabrics]);
    }

    public function addEditFabric(Request $request, $id=null){
        Session::flash('active', 'fabric');
        if($id == ""){
            $title = 'Add fabric';
        }else{
            $title= 'Edit fabric';
            $this->fabricData= Fabric::find($id);

            //update fabric post requst
           if($request->isMethod('post')){
                $this->validate($request, ['name' => 'required']);
                Fabric::updateFabric($request, $id);
                return redirect('/admin/fabrics')->with('message', 'Fabric Update Successfully');
           }
        }
            //fabric add post request
        if($request->isMethod('post')){
            $this->validate($request, ['name' => 'required']);
            Fabric::saveFabric($request);
            return redirect()->back()->with('message', 'fabric Save Successfully');
        }

        return view('admin.products_filter_pages.add-edit-fabric', ['title' => $title, 'fabricData' => $this->fabricData]);
    }

    public function updateFabricStatus(Request $request){
        Session::flash('active', 'fabric');
        if($request->ajax()){
            $this->fabric= Fabric::find($request->fabric_id);
            $this->fabricId= $this->fabric->id;
            $this->status= $this->fabric->status;
            if($this->status == 1){
                $this->status= 0;
            }else{
                $this->status= 1;
            }

            Fabric::where('id', $this->fabricId)->update(['status' => $this->status]);
            return response()->json(['status' => $this->status, 'fabric_id' => $this->fabricId]);
        }

    }

    public function deleteFabric($id){
        Session::flash('active', 'fabric');
        $fabric= Fabric::find($id);
        $fabric->delete();
        return redirect()->back()->with('message', 'fabric Deleted Successfully');
    }
}

