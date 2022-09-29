<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\Paginator;
use App\Category;
use App\Fabric;
use App\Fit;
use App\Http\Controllers\Controller;
use App\Occasion;
use App\Pattern;
use App\Product;
use App\Section;
use App\Sleeve;
use Illuminate\Http\Request;


class FrontProductController extends Controller
{

        //main cat and main cat er under a thaka sob sub category er all products come
    public function categoryProducts(Request $request){
        
            //ata 1st time page load hobar somomy false hobe tai else a jabe r akane if dilam karon page load hobar por keu jodi product filter krte chay tahole ata kaj krbe
        if($request->ajax()){

            $data= $request->all();
            //echo '<pre>'; print_r($data); die;
            $url= $data['url'];

            $catInfo= Category::categoryDetails($url); //Category model theke categoryDetails funtion jeta retun krce se result gula dhorlm catInfo diye
            $categoryProducts= Product::whereIn('category_id' , $catInfo['categoryIds'])->where('status',1); // akahne joto gula category id abong subCategory er id product table er category id er sathe mil hobe sob asbe tai whereIn use holo exple: tshirt cat er under a jodi 20 ta product thake r tshirt er under a thka jodi 10 ta sub cat thke r sei 10 ta  sub cat er under a jdi 200 product thke sub asbe aii whrein er jnno

            $categoryId=$catInfo['catDetails']['id']; //catinfo akta array tai array thke avabe id ta ber kore nilam
            $category= Category::find($categoryId); //view te category er name and parent name ta dekabo tai category ta niye jassi view te

                //if select fabric filter
                if(isset($data['fabric']) && !empty($data['fabric'])){
                    $categoryProducts->whereIn('products.fabric', $data['fabric']);
                }
                //if select pattern filter
                if(isset($data['pattern']) && !empty($data['pattern'])){
                    $categoryProducts->whereIn('products.pattern', $data['pattern']);
                }
                //if select sleeve filter
                if(isset($data['sleeve']) && !empty($data['sleeve'])){
                    $categoryProducts->whereIn('products.sleeve', $data['sleeve']);
                }
                //if select fit filter
                if(isset($data['fit']) && !empty($data['fit'])){
                    $categoryProducts->whereIn('products.fit', $data['fit']);
                }
                //if select occasion filter
                if(isset($data['occasion']) && !empty($data['occasion'])){
                    $categoryProducts->whereIn('products.occasion', $data['occasion']);
                }


                //if select sory by filter
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

            return view('front.products.ajax-category-products-filter', ['categoryProducts' => $categoryProducts]);
        }
        else{ // 1st time aii else block er code gulai run hobe oporer if kaj krbe na karon 1st request ta ajax hobe na sudu product filter er somoy e ajax request hobe tai tkn if block er code kaj krbe

                //domain er por je url thkbe ba kew type kore dibe sei url ta nilam avabe
            $url= Route::getFacadeRoot()->current()->uri();

                //oporer url a je url asbe oii url diye jodi kono category thake tahole category asbe na hole 404 page a niye jabe
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

                //product filters send to products.category-wise-products page
            //Prduct filters
        $fabricArray= Fabric::where('status', 1)->get();
        $patternArray= Pattern::where('status', 1)->get();
        $sleeveArray= Sleeve::where('status', 1)->get();
        $fitArray= Fit::where('status', 1)->get();
        $occasionArray= Occasion::where('status', 1)->get();
        $page= 'category_products';

            return view('front.products.category-wise-products', [
                'categoryProducts' => $categoryProducts,
                'category' => $category,
                'productsCount' => $productsCount,
                'fabricArray' => $fabricArray,
                'patternArray' => $patternArray,
                'sleeveArray' => $sleeveArray,
                'fitArray'  => $fitArray,
                'occasionArray' => $occasionArray,
                'page' => $page,
            ]);
        }
      }
    }
