<div class="form-group">
    <label>Select Category Level</label>
    <select name="parent_id" class="form-control select2" style="width: 100%;">
      <option value="0" {{ !empty($editCategoryData) && $editCategoryData->parent_id == 0 ? 'selected' : '' }}>Main Category</option>
      @if (!empty($categories))
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ !empty($editCategoryData) && $editCategoryData->parent_id == $category->id ? 'selected' : ''}}>{{ $category->category_name }}</option>
        @if(!empty($category->subCategory)){
            @foreach ($category->subCategory as $subCategory)
                <option value="{{ $subCategory->id }}">&nbsp;&gt;&gt;&nbsp;{{ $subCategory->category_name }}</option>
            @endforeach
        }
        @endif
        @endforeach
      @endif
    </select>
    <span class="text-danger">
        @error('parent_id')
            {{ $message }}
        @enderror
    </span>
  </div>


