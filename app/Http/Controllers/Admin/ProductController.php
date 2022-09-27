<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Fabric;
use App\Fit;
use App\Http\Controllers\Controller;
use App\Occasion;
use App\Pattern;
use App\Product;
use App\ProductAttribute;
use App\ProductImage;
use App\Section;
use App\Sleeve;
use Illuminate\Http\Request;
use Session;

class ProductController extends Controller
{
    protected $product;
    protected $products;
    protected $editProductData;
    protected $title;
    protected $status;
    protected $data;

    public function products(){
        Session::flash('active', 'product');
       // $this->products= Product::all();

       //amr jehuto section r category table er sudu name r id lagbe tai akhan thke sudu oii 2tay selec query krlam
       $this->products= Product::with(['section' => function($query){
            $query->select('id','name');
       },

       'category' => function($query){
            $query->select('id','category_name');
       },
    ])->orderBy('id','DESC')->get(); //with er por je chain method use krbo seta sudu product er opor e hobe jemon ami where use krte pari orderBy use krte pari

        return view('admin.products.products', [
            'products' => $this->products
        ]);
    }

    public function updateProductStatus(Request $request){
        Session::flash('active', 'product');

        if($request->ajax()){
            $this->data= $request->all();
            if($this->data['status'] == 'Active'){
                $this->status= 0;
            }else{
                $this->status= 1;
            }
            Product::where('id', $this->data['productId'])->update(['status' => $this->status]);
            return response()->json(['status' => $this->status, 'productId' => $this->data['productId']]);
        }
    }
    public function updateFeatureProductStatus(Request $request){
        Session::flash('active', 'product');

        if($request->ajax()){
            $this->product= Product::find($request->productId);
            if($this->product->is_featured == 'Yes'){
                $this->status= 'No';
            }else{
                $this->status= 'Yes';
            }
            Product::where('id', $this->product->id)->update(['is_featured' => $this->status]);
            return response()->json(['status' => $this->status]);
        }
    }

    public function addEditProductValidation($request, $id=null){
        //id null mane product add validation kaj krbe r id asa mane edit prodct kaj krbe
        if($id== ""){
            $rules=[
                'category_id' => 'required',
                'brand_id' => 'required',
                'product_name' => 'required',
                'product_code' => 'required',
                'product_color' => 'required',
                'product_price' => 'required|numeric',
                'main_image' => 'required|mimes:jpg,png',
                'product_video' => 'mimes:mp4'
            ];
        }else{
            $rules=[
                'category_id' => 'required',
                'brand_id' => 'required',
                'product_name' => 'required',
                'product_code' => 'required',
                'product_color' => 'required',
                'product_price' => 'required|numeric',
                'main_image' => 'mimes:jpg,png',
                'product_video' => 'mimes:mp4'
            ];
        }


        $customMessage=[
            'category_id.required' => 'Please Select Category',
            'brand_id.required' => 'Please Select Brand',
            'product_video.mimes' => 'Please upload mp4'
        ];

        $this->validate($request,$rules,$customMessage);
    }

    public function addEditProduct(Request $request, $id=null){
        Session::flash('active', 'product');
        if($id == ""){
            $this->title= "Add Product";
        }else{
            $this->title= "Edit Product";

            $this->editProductData= Product::find($id);

            //product edit krte ase jkn update korbe tkn method ta post tai avabe dilam
            if($request->isMethod('post')){
                $this->addEditProductValidation($request, $id);
                Product::updateProduct($request, $id);
                return redirect('/admin/products')->with('message', 'Product Edit Successfully');
            }
        }

        if($request->isMethod('post')){
            $this->addEditProductValidation($request);
            $prodctCodeExistsCheck= Product::addProduct($request);
            if($prodctCodeExistsCheck){
                return $prodctCodeExistsCheck;
            }
            return redirect()->back()->with('message', 'Product Added Successfully');
        }
            //section with category and subcategory section a hasmany reltin ase
        $categories= Section::where('status', 1)->get();
        $brands= Brand::where('status', 1)->get();

        //Prduct filters
        $fabricArray= Fabric::where('status', 1)->get();
        $patternArray= Pattern::where('status', 1)->get();
        $sleeveArray= Sleeve::where('status', 1)->get();
        $fitArray= Fit::where('status', 1)->get();
        $occasionArray= Occasion::where('status', 1)->get();

        return view('admin.products.add-edit-product',[
            'title' => $this->title,
            'categories' => $categories,
            'brands' => $brands,
            'editProductData' => $this->editProductData,
            'fabricArray' => $fabricArray,
            'patternArray' => $patternArray,
            'sleeveArray' => $sleeveArray,
            'fitArray' => $fitArray,
            'occasionArray' => $occasionArray,
        ]);
    }

    public function productCodeExistCheck(Request $request){
        if($request->ajax()){
            $codeExistCheck= Product::where('product_code', $request->code)->first();
            if($codeExistCheck){
                return 'true';
            }
        }
    }

    //aii function ta static krlam karon ata category controller a use krbo tai kew jodi category delete kore tkn to sei category er product o delete krte hobe tai static krlam
    public static function deleteProduct($id){
        $product= Product::find($id);
        $subImage= ProductImage::where('product_id',$id)->get();
        $productAttribute= ProductAttribute::where('product_id', $id)->get();
        foreach($subImage as $image){
                //delete from folder
            if(file_exists('images/product-image/sub-images/'.$image->images)){
                unlink('images/product-image/sub-images/'.$image->images);
            }
                //delete from db
            $image->delete();
        }

        foreach($productAttribute as $attribute){
            $attribute->delete();
        }


        if(file_exists('images/product-image/large/'.$product->main_image)){
            unlink('images/product-image/large/'.$product->main_image);
            unlink('images/product-image/medium/'.$product->main_image);
            unlink('images/product-image/small/'.$product->main_image);
        }

        if(file_exists($product->product_video)){
            unlink($product->product_video);
        }

        $product->delete();
        return back()->with('message', 'Product Delete Successfully');
    }


        //avabe function diye spacific view design kore sekhane video play kora jabe
    public function playProductVideo($name, $id){
        $product= Product::find($id);
        $productVideo= $product->product_video;
        return view('admin.products.play-video', ['productVideo' => $productVideo]);
    }

    public function deleteProductVideo($id){

        $product= Product::find($id);
        if(file_exists($product->product_video)){
            unlink($product->product_video);
        }

        $product->product_video= "";
        $product->save();

        return redirect()->back()->with('message', 'Product Video Delete Success');

    }

    public function adminProductDetails($id){
        $product= Product::find($id);
        return view('admin.products.admin-product-details', ['product' => $product]);
    }
}
