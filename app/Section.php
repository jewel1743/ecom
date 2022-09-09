<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable =['name','status'];

    public function categories(){
        //aii section er primay key category table er section_id field er joto gula row te ase sob gula retun krte and with mane sathe subcategory o retun krbe
        return $this->hasMany(Category::class, 'section_id')->where(['parent_id'=> 0, 'status' => 1])->with('subCategory');
    }
}
