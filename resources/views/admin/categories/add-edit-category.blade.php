@extends('master.admin-master.master')

@section('title')
    Add Category
@endsection

@section('admin-css')
<link rel="stylesheet" href="{{ asset('/') }}admin/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('/') }}admin/dist/css/adminlte.min.css">
@endsection

@section('body')
    @if (Session::has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h4>{{ Session::get('message') }}</h4>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Category</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Add Category</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<section class="content">
    <div class="container-fluid">
      <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>

        <form action="{{ !empty($editCategoryData) ? route('add-edit-category', ['id' => $editCategoryData->id])  : route('add-edit-category')  }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Select Section</label>
                      <select name="section_id" id="sectionId" class="form-control select2" style="width: 100%;">
                        <option disabled selected>--Select a Section--</option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}" {{ !empty($editCategoryData) && $editCategoryData->section_id == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger">
                        @error('section_id')
                            {{ $message }}
                        @enderror
                    </span>
                    </div>
                    <div id="appendCategoryLevel">
                        @include('admin.categories.append-category-lavel')
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                      <label>Category Name</label>
                      <input type="text" name="category_name" value="{{ !empty($editCategoryData) ? $editCategoryData->category_name : '' }}" class="form-control" placeholder="Category Name">
                      <span class="text-danger">
                        @error('category_name')
                            {{ $message }}
                        @enderror
                    </span>
                    </div>
                    <div class="form-group">
                      <label for="Category_Image">Category Image</label>
                          <input type="file" class="form-control-file" name="category_image" id="category_Image" accept="image/*">
                          @if (isset($editCategoryData) && !empty($editCategoryData->category_image))
                           <div class="mt-1 ml-2">
                            <img src="{{ asset($editCategoryData->category_image) }}" alt="" height="50" width="50">
                            <a class="d-block" target="_blank" href="{{ asset($editCategoryData->category_image) }}">View Image</a>
                            <a class="confirmDelete" href="javascript:void(0);" record="category-image" recordId="{{ $editCategoryData->id }}">Delete Image</a>
                           </div>
                          @endif
                          <span class="text-danger">
                            @error('category_image')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea class="form-control" name="description" rows="3" placeholder="Enter ...">{{ !empty($editCategoryData) ? $editCategoryData->description : '' }}</textarea>
                    </div>
                    <!-- /.form-group -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Category Discount</label>
                          <input type="number" class="form-control" value="{{ !empty($editCategoryData) ? $editCategoryData->category_discount : '' }}" name="category_discount" placeholder="Category Discount">
                      </div>
                      <div class="form-group">
                          <label>Category Url</label>
                          <input class="form-control" value="{{ !empty($editCategoryData) ? $editCategoryData->url : '' }}" name="url" placeholder="Category Url">
                      </div>
                      <div class="form-group">
                          <label>Meta Title</label>
                          <textarea class="form-control" value="{{ !empty($editCategoryData) ? $editCategoryData->meta_title : '' }}" name="meta_title" rows="3" placeholder="Enter ..."></textarea>
                      </div>
                      <div class="form-group">
                          <label>Meta Description</label>
                          <textarea class="form-control" value="{{ !empty($editCategoryData) ? $editCategoryData->meta_description : '' }}" name="meta_description" rows="3" placeholder="Enter ..."></textarea>
                      </div>
                      <div class="form-group">
                          <label>Meta Keywords</label>
                          <textarea class="form-control" value="{{ !empty($editCategoryData) ? $editCategoryData->meta_keywords : '' }}" name="meta_keywords" rows="3" placeholder="Enter ..."></textarea>
                      </div>
                    <!-- /.form-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <div>
              </div>
              <div class="card-footer">
                @if (!empty($editCategoryData))
                 <button class="btn btn-success">Update Category</button>
                 @else
                 <button class="btn btn-success">Save Category</button>
                @endif
              </div>
        </form>

      </div>
      <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
  </section>
@endsection

@section('admin-js')
<script src="{{ asset('/') }}admin/plugins/select2/js/select2.full.min.js"></script>
<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
    })
  </script>
  <script>
    $('#sectionId').change(function(){
        var section_id= $(this).val();
        $.ajax({
            type: 'post',
            url: '{{ route('append-category-level') }}',
            data: {section_id:section_id},
            success: function(resp){
                $('#appendCategoryLevel').html(resp);
            },
            error: function(error){
                console.log(error);
            }
        });
    });
  </script>
  <script>
    // //manual simple message
    // $('.confirmDelete').click(function(){
    //     var record= $(this).attr("record");
    //     if(confirm("are you sure delete this "+record+" image ?")){
    //        return true;
    //     }
    //     return false;
    // });

    $(".confirmDelete").click(function(){
        var record= $(this).attr("record");
        var recordId= $(this).attr("recordId");
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {

            //delete er por akta window message er jnno
            // Swal.fire(
            // 'Deleted!',
            // 'Your file has been deleted.',
            // 'success',
            // )

                //url diye delete krte chaile avabe
            window.location.href="{{ url('/') }}/admin/delete-"+record+"/"+recordId;

        //    form diye delete krte chile
        //    $('#confirmDeleteForm').submit();

        }
        })
    });

  </script>
@endsection
