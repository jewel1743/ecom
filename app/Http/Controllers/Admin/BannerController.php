<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class BannerController extends Controller
{
    protected $banners;
    protected $banner;
    protected $bannerId;
    protected $status;
    protected $bannerData;

    public function index(){
        Session::flash('active', 'banner');
        $this->banners = Banner::orderBy('id','DESC')->get();
        return view('admin.banners.banner', ['banners' => $this->banners]);
    }

    public function addEditBanner(Request $request, $id=null){
        if($id == ""){
            $title = 'Add Banner';
        }else{
            $title= 'Edit Banner';
            $this->bannerData= Banner::find($id);

            //update brand post requst
           if($request->isMethod('post')){
                $this->validate($request, ['image' => 'mimes:png,jpg']);
                Banner::updateBanner($request, $id);
                return redirect('/admin/banners')->with('message', 'Banner Update Successfully');
           }
        }
            //brand add post request
        if($request->isMethod('post')){
            $this->validate($request, ['image' => 'required|mimes:png,jpg']);
            Banner::saveBanner($request);
            return redirect()->back()->with('message', 'Banner Save Successfully');
        }

        return view('admin.banners.add-edit-banner', ['title' => $title, 'bannerData' => $this->bannerData]);
    }

    public function updateBannerStatus(Request $request){
        Session::flash('active', 'brand');
        if($request->ajax()){
            $this->banner= Banner::find($request->banner_id);
            $this->bannerId= $this->banner->id;
            $this->status= $this->banner->status;
            if($this->status == 1){
                $this->status= 0;
            }else{
                $this->status= 1;
            }

            Banner::where('id', $this->bannerId)->update(['status' => $this->status]);
            return response()->json(['status' => $this->status, 'banner_id' => $this->bannerId]);
        }

    }

    public function deleteBanner($id){
        $banner= Banner::find($id);
        if(file_exists($banner->image)){
            unlink($banner->image);
        }

        $banner->delete();
        return redirect()->back()->with('message', 'Banner Deleted Successfully');
    }
}
