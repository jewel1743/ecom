<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable=
    [
        'parent_id',
        'section_id',
        'category_name',
        'category_image',
        'category_discount',
        'description',
        'url',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
    ];

    protected static $image,$imageName,$imageUrl,$directory;
    protected static $category;

    public static function getImageUrl($request){
        self::$image= $request->file('category_image');
        if(self::$image){
            self::$imageName= 'category_img'.time().'.'.self::$image->getClientOriginalExtension();
            self::$directory= 'images/category_img/';
            self::$imageUrl= self::$directory.self::$imageName;
            self::$image->move(self::$directory, self::$imageName);
            return self::$imageUrl;
        }else{
            return '';
        }
    }
    public static function saveCategory($request){
        self::$category= new Category();
        self::saveBasicInfo(self::$category, $request, self::getImageUrl($request));
    }

    public static function editCategory($request, $id){
        self::$category= Category::find($id);
        if($request->file('category_image')){
            if(file_exists(self::$category->category_image)){
                unlink(self::$category->category_image);
            }
            self::$imageUrl= self::getImageUrl($request);
        }
        else{
            self::$imageUrl= self::$category->category_image;
        }

        self::saveBasicInfo(self::$category, $request,self::$imageUrl);
    }


    private static function saveBasicInfo($category, $request, $imgUrl){
        $category->parent_id= $request->parent_id;
        $category->section_id= $request->section_id;
        $category->category_name= $request->category_name;
        $category->category_image= $imgUrl;
        $category->category_discount= $request->category_discount;
        $category->description= $request->description;
        $category->url= $request->url;
        $category->meta_title= $request->meta_title;
        $category->meta_description= $request->meta_description;
        $category->meta_keywords= $request->meta_keywords;
        $category->save();
    }

    public function subCategory(){
        return $this->hasMany(Category::class, 'parent_id')->where('status', 1); //category table er primary key jdi kono category table er parent_id hoy tahole se row gula return krbe
    }

    public function section(){
        return $this->belongsTo(Section::class); //ai category table er sectio_id filed er value section table er je primay key field er value sathe ak hobe se akta row return krbe
    }


    public function parentCategory(){
        return $this->belongsTo(Category::class, 'parent_id'); //akhae ->select('id','name') avabe deya jabe jodi nirdisto kisu lage sob na niye..
    }

    public static function categoryDetails($url){

        //ata array method amr boss er method ata ecom series master er
      $catDetails= Category::select('id','category_name','url')->with(['subCategory' => function($query){
        $query->select('id','parent_id')->where('status',1); // subCategory sob info dorkar nai tai avabe nilam
      }])->where(['url' => $url,'status' => 1])->first()->toArray(); //end chainging
        $catIds= array(); //ata akta array kore nilam karon atate onek subcat id  store hote pare
        //
        $categoryIds[]= $catDetails['id']; //atae main category id ta asbe  abong ata 0 index a save hobe aii array er

        //aii category er under a joto subcategory ase segular jnno for each
      foreach($catDetails['sub_category'] as $category){ // ata jodi array  na hoye json abject hoto tahole relation name ta $catDetails['sub_category'] na hoye $catDetails->subCategory amn hoto,, ata jehuto array kore nici tai relation name ta sub_category amn hoyce sub er por Upprcse C subCategory amn ase tai majhe _ ata diye sub_category amn hyce
        $categoryIds[]= $category['id']; //main category er under a joto subCat ase sobar sudu id aii array te save er jnno
      }

      
      return array('categoryIds' => $categoryIds, 'catDetails' => $catDetails); // catids te main catid and main cat er under joto subCat ase tar id nilm r R catDetails a ja select krci sudu tai e nilam

    //     //json array method amar moto kore ata laravel er
    //     $category= Category::where(['url' => $url, 'status' => 1])->first();
    //     $categoryIds= array();
    //     $categoryIds[]= $category->id;
    //     foreach($category->subCategory as $subCat){
    //         $categoryIds[]= $subCat->id;
    //     }

    //     return array('categoryIds' => $categoryIds, 'category' => $category);

    }
}
