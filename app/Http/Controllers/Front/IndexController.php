<?php

namespace App\Http\Controllers\Front;

use App\Banner;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){

        $featureProduct= Product::where(['is_featured' => 'Yes', 'status' => 1])->orderBy('id', 'DESC')->get()->toArray(); //toArray function use krlam karon ami ata json thek arry kore rakalm karon ami array_chunk use krbo tai,kron array_chunk fntion use krte hole seta array hote hobe
        $featureProductCount= count($featureProduct);
        $featureItemChunk= array_chunk($featureProduct, 4); //array_chunk function er 1st ta dite hoy ami kn array theke data anbo r 2nd ta dite hoy oii array thke koyta kore data niye akta array krbo. ata ke print kore dekle clear hoya jabe
        //$latestProducts= Product::orderBy('id','DESC')->take(6)->get(); avabe o newa jay limit er ta
       $latestProducts= Product::where('status', 1)->orderBy('id','DESC')->limit(6)->get();
        $banners = Banner::where('status', 1)->get();
       return view('front.home.index', [
            'featureItemChunk' => $featureItemChunk,
            'featureProductCount' => $featureProductCount,
            'latestProducts' => $latestProducts,
            'banners' => $banners,
        ]);
    }
}
