<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
class ProductImagesController extends Controller
{

    public function productImages(Request $request, $id){

        $productData= Product::with('subImages')->select('id','product_name','product_code','product_color','product_price','main_image')->find($id);
        $subImage= ProductImage::where('product_id', $id)->get();
        if($request->isMethod('post')){

                //avabe o array image validation kora jay,, cstm msg er jnno images.*.mimes => 'msg ta' avabe
            //  $this->validate($request, [
            //     'images' => 'required|array',
            //     'images.*' => 'mimes:png,jpg',
            //  ]);

            //ProductImage model thke error er jnno return kora hyce tai seta dhora hyce akhane
          $error= ProductImage::saveImages($request, $id);

          //jodi model theke error ase thle sei error return krle view te r na asle else er ta return krbe
          if($error){
            return $error;
          }else{
            return redirect()->back()->with('message', 'Product Images Added Successfully');
          }

        }

        return view('admin.products.product-images', ['productData' => $productData, 'subImage' => $subImage]);
    }

    public function updateImageStatus(Request $request){
        if($request->ajax()){
            $status= $request->status;
            $imageId= $request->imageId;
            if($status == 'Active'){
                $status= 0;
            }else{
                $status= 1;
            }

            ProductImage::where('id',$imageId)->update(['status' => $status]);
            return response()->json(['status' => $status]);
        }
    }

    public function deleteSubImage($id){
        $subImage= ProductImage::find($id);
        if(file_exists('images/product-image/sub-images/'.$subImage->images)){
            unlink('images/product-image/sub-images/'.$subImage->images);
        }
       // ProductImage::where('id',$id)->delete();
       $subImage->delete();
        return back()->with('message','Product Image Delete Successfully');
    }
}
