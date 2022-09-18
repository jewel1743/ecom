<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class BrandController extends Controller
{
    protected $brands;
    protected $brand;
    protected $brandId;
    protected $status;
    protected $brandData;

    public function index(){
        Session::flash('active', 'brand');
        $this->brands = Brand::all();
        return view('admin.brands.brands', ['brands' => $this->brands]);
    }

    public function addEditBrand(Request $request, $id=null){
        if($id == ""){
            $title = 'Add Brand';
        }else{
            $title= 'Edit Brand';
            $this->brandData= Brand::find($id);

            //update brand post requst
           if($request->isMethod('post')){
                $this->validate($request, ['brand_name' => 'required', 'brand_image' => 'mimes:png,jpg']);
                Brand::updateBrand($request, $id);
                return redirect('/admin/brands')->with('message', 'Brand Update Successfully');
           }
        }
            //brand add post request
        if($request->isMethod('post')){
            $this->validate($request, ['brand_name' => 'required', 'brand_image' => 'mimes:png,jpg']);
            Brand::saveBrand($request);
            return redirect()->back()->with('message', 'Brand Save Successfully');
        }

        return view('admin.brands.add-edit-brand', ['title' => $title, 'brandData' => $this->brandData]);
    }

    public function updateBrandStatus(Request $request){
        Session::flash('active', 'brand');
        if($request->ajax()){
            $this->brand= Brand::find($request->brand_id);
            $this->brandId= $this->brand->id;
            $this->status= $this->brand->status;
            if($this->status == 1){
                $this->status= 0;
            }else{
                $this->status= 1;
            }

            Brand::where('id', $this->brandId)->update(['status' => $this->status]);
            return response()->json(['status' => $this->status, 'brand_id' => $this->brandId]);
        }

    }

    public function deleteBrand($id){
        $brand= Brand::find($id);
        if(file_exists($brand->brand_image)){
            unlink($brand->brand_image);
        }

        $brand->delete();
        return redirect()->back()->with('message', 'Brand Deleted Successfully');
    }
}
