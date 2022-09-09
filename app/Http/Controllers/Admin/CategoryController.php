<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Section;
use Illuminate\Http\Request;
use Session;

class CategoryController extends Controller
{
    protected $category;
    protected $editCategoryData;
    protected $title;
    protected $categories;
    protected $categoryId;
    protected $status;

    public function index(){

        Session::flash('active','category');
            //category relation functio  avabe with kore niye geleo hobe na nileo hobe
        $this->categories= Category::with(['section','parentCategory'])->where('status', 1)->get();
        return view('admin.categories.category', ['categories' => $this->categories]);

    }

    public function updateCategoryStatus(Request $request){
        Session::flash('active', 'section');
        if($request->ajax()){
            $this->categoryId= $request->category_id;
            $this->status= $request->status;
            if($this->status == 'Active'){
                $this->status= 0;
            }else{
                $this->status= 1;
            }

            Category::where('id', $this->categoryId)->update(['status' => $this->status]);
            return response()->json(['status' => $this->status, 'category_id' => $this->categoryId]);
        }

    }

    public function addEditCategoryValidate($request){
        $rules=[
            'section_id' => 'required',
            'parent_id' => 'required',
            'category_name' => 'required|regex:/^[\pL\s]+$/u|min:3',
            'category_image' => 'mimes:jpg,png',
        ];

        $customMsg=[
            'section_id.required' => 'Section Name is Required',
            'parent_id.required' => 'Category Level is Required',
            'category_name.regex' => 'Allow Only Cherecter And Space',
            'image.mimes' => 'Please Select jpg or png Images file',
        ];

        $this->validate($request,$rules,$customMsg);
    }

    public function addEditCategory(Request $request, $id=null){
        if($id==""){
            //request jdi get hoy and sathe jodi id na ase tahole ata kaj kore sections=all and return a jabe
            $this->title= 'Add Category';
        }else{
            //request jdi get hoy and sthe id ase tahole nicher 3 ta kaj kore sections=all and return a jabe
            $this->title= 'Edit Category';
            $this->editCategoryData= Category::find($id);
            $this->categories= Category::where(['section_id' => $this->editCategoryData->section_id, 'parent_id' => 0])->get();

            //request jodi post hoy and sathe jdi id ase thle nicher functon kaj krbe
            if($request->isMethod('post')){
                //validation edit category form on my own created function above
                $this->addEditCategoryValidate($request);

                //category edit functionality
                // $check= Category::find($id);
                // if($check->parent_id == 0){
                //     $check= 'main category edit krte asci';
                // }else{
                //     $check= 'Sub category edit krte asci';
                // }
                // return $check;

                Category::editCategory($request,$id);
                return redirect('/admin/categories')->with('message', 'Category Update Successfully');
            }

        }

        if($request->isMethod('post')){
                //validation add category form on my own created function above
                $this->addEditCategoryValidate($request);
                //save from category model jst call here
            Category::saveCategory($request);
            Session::flash('message', 'Category Create Successfully');
        }

        $sections= Section::all();
        return view('admin.categories.add-edit-category',['sections' => $sections, 'title' => $this->title, 'editCategoryData' => $this->editCategoryData, 'categories' => $this->categories]);

    }

    public function appendCategoryLevel(Request $request){

            if($request->ajax()){
                $sectionId= $request->section_id;
                $categories= Category::with('subCategory')->where(['section_id' => $sectionId, 'parent_id' => 0, 'status' => 1])->get();
                return view('admin.categories.append-category-lavel',['categories' => $categories]);
            }

    }

    public function deleteCategory($id){
        $this->category= Category::find($id);
        $this->category->delete();
        return back()->with('message', 'Category Delete Successfully');
    }

    public function deleteCategoryImage($id){
        $this->category= Category::find($id);
        if(file_exists($this->category->category_image)){
            unlink($this->category->category_image);
        }
        $this->category->category_image= null;
        $this->category->save();
        return back()->with('message', 'Category Image Delete Successfully');
    }
}
