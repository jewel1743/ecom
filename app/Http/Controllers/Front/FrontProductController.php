<?php

namespace App\Http\Controllers\Front;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Section;
use Illuminate\Http\Request;


class FrontProductController extends Controller
{

    protected $sort;

        //main cat and main cat er under a thaka sob sub category er all products come
    public function categoryProducts($url, Request $request){

        if($request->ajax()){

            $data= $request->all();
           $this->sort= $data['sort'];
            $url= $data['url'];

            $catInfo= Category::categoryDetails($url); //Category model theke categoryDetails funtion jeta retun krce se result gula dhorlm catInfo diye
            $categoryProducts= Product::whereIn('category_id' , $catInfo['categoryIds'])->where('status',1); // akahne joto gula category id abong subCategory er id product table er category id er sathe mil hobe sob asbe tai whereIn use holo exple: tshirt cat er under a jodi 20 ta product thake r tshirt er under a thka jodi 10 ta sub cat thke r sei 10 ta  sub cat er under a jdi 200 product thke sub asbe aii whrein er jnno

            $categoryId=$catInfo['catDetails']['id']; //catinfo akta array tai array thke avabe id ta ber kore nilam
            $category= Category::find($categoryId); //view te category er name and parent name ta dekabo tai category ta niye jassi view te

            if(isset($data['sort']) && !empty($data['sort'])){
                if($data['sort'] == 'latest_products'){
                    $categoryProducts->orderBy('id','DESC');
                }
                else if($data['sort'] == 'product_name_a_z'){
                    $categoryProducts->orderBy('product_name','ASC');
                }
                else if($data['sort'] == 'product_name_z_a'){
                    $categoryProducts->orderBy('product_name','DESC');
                }
                else if($data['sort'] == 'price_lowest_first'){
                    $categoryProducts->orderBy('product_price','ASC');
                }
                else if($data['sort'] == 'price_highest_first'){
                    $categoryProducts->orderBy('product_price','DESC');
                }
            }else{
                $categoryProducts->orderBy('id','DESC');
            }

            $categoryProducts= $categoryProducts->paginate(3);

            return view('front.products.ajax-category-products-filter', ['categoryProducts' => $categoryProducts, 'sort' => $this->sort]);
        }
        else{

            $categoryCount= Category::where(['url' => $url, 'status' => 1])->count();
            if($categoryCount >0){
             $catInfo= Category::categoryDetails($url); //Category model theke categoryDetails funtion jeta retun krce se result gula dhorlm catInfo diye
               $categoryProducts= Product::whereIn('category_id' , $catInfo['categoryIds'])->where('status',1); // akahne joto gula category id abong subCategory er id product table er category id er sathe mil hobe sob asbe tai whereIn use holo exple: tshirt cat er under a jodi 20 ta product thake r tshirt er under a thka jodi 10 ta sub cat thke r sei 10 ta  sub cat er under a jdi 200 product thke sub asbe aii whrein er jnno
            }else{
                abort(404);
            }

            $categoryId=$catInfo['catDetails']['id']; //catinfo akta array tai array thke avabe id ta ber kore nilam
            $category= Category::find($categoryId); //view te category er name and parent name ta dekabo tai category ta niye jassi view te
            $productsCount= Product::whereIn('category_id' , $catInfo['categoryIds'])->where('status',1)->count(); //view te category wise koyta product ase ta show korabo tai nilam

            $categoryProducts= $categoryProducts->paginate(3);

            return view('front.products.category-wise-products', ['categoryProducts' => $categoryProducts, 'category' => $category, 'productsCount' => $productsCount]);
        }
      }
    }
