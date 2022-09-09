<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductAttribute;
use Illuminate\Http\Request;
use Session;

class ProductAttributeController extends Controller
{



    public function productAttribute(Request $request, $id){

        if($request->isMethod('post')){

            //all product attribute save from proudctAttribute model
           $returnValue= ProductAttribute::saveProductAttribute($request, $id);
            return $returnValue;
        }

        $productData= Product::find($id);

        return view('admin.products.product-attribute', ['productData' => $productData]);
    }

    public function updateAttribute(Request $request){
        $data= $request->all();
            //if diye chk krlm product attribute jdi empty thke thle nothing msg dekhabe r emty na thkle update krbe
        if(!empty($data['attributeId'])){
            foreach($data['attributeId'] as $key => $value){
                if(!empty($value)){
                     ProductAttribute::where('id', $value)->update(['size' => $data['size'][$key], 'sku' => $data['sku'][$key], 'price' => $data['price'][$key], 'stock' => $data['stock'][$key]]);
                 }
            }

            return redirect()->back()->with('message', 'Attribute Update Successfully');
        }else{
            return back()->with('existValue', 'Nothing to update. Product Attribute Empty');
        }


    }

    public function updateAttributeStatus(Request $request){
        if($request->ajax()){
            $status = $request->status;
            $attributeId= $request->attributeId;
            if($status == 'Enable'){
                $status= 0;
            }else{
                $status= 1;
            }

            ProductAttribute::where('id',$attributeId)->update(['status' => $status]);
            return response()->json(['status' => $status]);
        }
    }

    public function deleteProductAttribute($id){
        ProductAttribute::where('id', $id)->delete();
        return back()->with('message', 'Product Attribute Delete Successfully');
    }
}
