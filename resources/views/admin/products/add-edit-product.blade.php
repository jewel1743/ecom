@extends('master.admin-master.master')

@section('title')
    {{ $title }}
@endsection

@section('admin-css')
    <link rel="stylesheet" href="{{ asset('/') }}admin/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection

@section('body')
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <h1>{{ $title }}</h1>
                    </div>
                    <div class="col-md-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    @if (Session::has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <h4>{{ Session::get('message') }}</h4>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (Session::has('exist_message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h4>{{ Session::get('product_code') . Session::get('exist_message') }}</h4>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- /.card-header -->
                    <form
                        action="{{ !empty($editProductData) ? route('add-edit-product', ['id' => $editProductData->id]) : route('add-edit-product') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Category</label>
                                        <select name="category_id" class="form-control select2bs4" style="width: 100%;">
                                            <option selected disabled>---Select a Category---</option>
                                            @foreach ($categories as $section)
                                                <optgroup label="{{ $section->name }}"></optgroup>
                                                @foreach ($section->categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ !empty($editProductData) && $editProductData->category_id == $category->id ? 'selected' : '' }}>
                                                        &nbsp;&nbsp; --{{ $category->category_name }}</option>
                                                    @foreach ($category->subCategory as $subCategory)
                                                        <option value="{{ $subCategory->id }}"
                                                            {{ !empty($editProductData) && $editProductData->category_id == $subCategory->id ? 'selected' : '' }}>
                                                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;--
                                                            &nbsp;{{ $subCategory->category_name }}</option>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Select Brand</label>
                                        <select name="brand_id" class="form-control select2bs4" style="width: 100%;">
                                            <option selected disabled>---Select a Brand---</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                    {{ !empty($editProductData) && $editProductData->brand_id == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->brand_name }}
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input name="product_name" type="text" class="form-control"
                                            value="{{ !empty($editProductData) ? $editProductData->product_name : old('product_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Code</label>
                                        <input id="codeCheck" name="product_code" type="text" class="form-control"
                                            value="{{ !empty($editProductData) ? $editProductData->product_code : old('product_code') }}">
                                        <div><span id="codeExistMessage" class="text-danger"></span></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Color</label>
                                        <input name="product_color" type="text" class="form-control"
                                            value="{{ !empty($editProductData) ? $editProductData->product_color : old('product_color') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input name="product_price" type="text" class="form-control"
                                            value="{{ !empty($editProductData) ? $editProductData->product_price : old('product_price') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Discount</label>
                                        <input name="product_discount" type="text" class="form-control"
                                            value="{{ !empty($editProductData) ? $editProductData->product_discount : old('product_discount') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Weight</label>
                                        <input name="product_weight" type="text" class="form-control"
                                            value="{{ !empty($editProductData) ? $editProductData->product_weight : old('product_weight') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Product Video</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="product_video" class="custom-file-input"
                                                    id="exampleInputFile" accept="video/*">
                                                <label class="custom-file-label" for="exampleInputFile">Choose
                                                    file</label>
                                            </div>
                                        </div>
                                        @if (!empty($editProductData) && !empty($editProductData->product_video))
                                            <div>
                                                {{-- <a target="_blank" href="{{ asset($editProductData->product_video) }}">View Video</a> --}}
                                                <a target="_blank"
                                                    href="{{ route('play-product-video', ['name' => $editProductData->product_name, 'id' => $editProductData->id]) }}">View
                                                    Video</a>
                                                <a class="confirmDelete" record="product-video"
                                                    recordId="{{ $editProductData->id }}"
                                                    href="javascript:void(0);">Delete Video</a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Main Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="main_image" class="custom-file-input"
                                                    id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose
                                                    file</label>
                                            </div>
                                        </div>
                                        @if (!empty($editProductData) && !empty($editProductData->main_image))
                                            <img src="{{ asset('images/product-image/large/' . $editProductData->main_image) }}"
                                                alt="" height="50" width="50">
                                            <a target="_blank"
                                                href="{{ asset('images/product-image/large/' . $editProductData->main_image) }}">View
                                                Image</a>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <textarea id="summernote" name="short_description" class="form-control" rows="3" placeholder="Enter ...">{{ !empty($editProductData) ? $editProductData->short_description : old('short_description') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Long Description</label>
                                        <textarea  name="long_description" class="form-control summernote" rows="3" placeholder="Enter ...">{{ !empty($editProductData) ? $editProductData->long_description : old('long_description') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Wash Care</label>
                                        <input name="wash_care" type="text" class="form-control"
                                            value="{{ !empty($editProductData) ? $editProductData->wash_care : old('wash_care') }}">
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Fabric</label>
                                        <select name="fabric" class="form-control" style="width: 100%;">
                                            <option style="" selected disabled>---Select a Fabric---</option>
                                            @foreach ($fabricArray as $fabric)
                                                <option value="{{ $fabric->name }}"
                                                    {{ !empty($editProductData) && $editProductData->fabric == $fabric->name ? 'selected' : '' }}
                                                    {{ old('fabric') == $fabric->name ? 'selected' : '' }}>
                                                    {{ $fabric->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Select Pattern</label>
                                        <select name="pattern" class="form-control" style="width: 100%;">
                                            <option style="" selected disabled>---Select a Pattern---</option>
                                            @foreach ($patternArray as $pattern)
                                                <option value="{{ $pattern->name }}"
                                                    {{ !empty($editProductData) && $editProductData->pattern == $pattern->name ? 'selected' : '' }}
                                                    {{ old('pattern') == $pattern->name ? 'selected' : '' }}>
                                                    {{ $pattern->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Select Sleeve</label>
                                        <select name="sleeve" class="form-control" style="width: 100%;">
                                            <option style="" selected disabled>---Select a Sleeve---</option>
                                            @foreach ($sleeveArray as $sleeve)
                                                <option value="{{ $sleeve->name }}"
                                                    {{ !empty($editProductData) && $editProductData->sleeve == $sleeve->name ? 'selected' : '' }}
                                                    {{ old('sleeve') == $sleeve->name ? 'selected' : '' }}>
                                                    {{ $sleeve->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Select Fit</label>
                                        <select name="fit" class="form-control" style="width: 100%;">
                                            <option style="" selected disabled>---Select a Fit---</option>
                                            @foreach ($fitArray as $fit)
                                                <option value="{{ $fit->name }}"
                                                    {{ !empty($editProductData) && $editProductData->fit == $fit->name ? 'selected' : '' }}
                                                    {{ old('fit') == $fit->name ? 'selected' : '' }}>{{ $fit->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Select Occasion</label>
                                        <select name="occasion" class="form-control" style="width: 100%;">
                                            <option style="" selected disabled>---Select a Occasion---</option>
                                            @foreach ($occasionArray as $occasion)
                                                <option value="{{ $occasion->name }}"
                                                    {{ !empty($editProductData) && $editProductData->occasion == $occasion->name ? 'selected' : '' }}
                                                    {{ old('occasion') == $occasion->name ? 'selected' : '' }}>
                                                    {{ $occasion->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Title </label>
                                        <textarea name="meta_title" class="form-control" rows="3" placeholder="Enter ...">{{ !empty($editProductData) ? $editProductData->meta_title : old('meta_title') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <textarea name="meta_description" class="form-control" rows="3" placeholder="Enter ...">{{ !empty($editProductData) ? $editProductData->meta_description : old('meta_description') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Keywords</label>
                                        <textarea name="meta_keywords" class="form-control" rows="3" placeholder="Enter ...">{{ !empty($editProductData) ? $editProductData->meta_keywords : old('meta_keywords') }}</textarea>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label>Feature Product <input type="checkbox" name="is_featured" value="Yes"
                                                style="padding:10px; margin:10px;"
                                                {{ !empty($editProductData) && $editProductData->is_featured == 'Yes' ? 'checked' : '' }}
                                                {{ old('is_featured') == 'Yes' ? 'checked' : '' }}></label>

                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="card-footer">
                            @if (!empty($editProductData))
                                <button type="submit" class="btn btn-success">Update Product</button>
                            @else
                                <button type="submit" class="btn btn-success">Add Product</button>
                            @endif
                        </div>
                    </form>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('admin-js')
    <!-- Select2 -->
    <script src="{{ asset('/') }}admin/plugins/select2/js/select2.full.min.js"></script>
    {{-- file upload er por input fild er vitore file er name show er jonno --}}
    <script src="{{ asset('/') }}admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

        })
    </script>

    <script>
        //file upload er por input fild er vitore file er name show er jonno
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <script>
        $('.confirmDelete').click(function() {
            var record = $(this).attr("record");
            var recordId = $(this).attr("recordId");

            //sweet alert
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
                    window.location.href = "{{ url('/') }}/admin/delete-" + record + "/" + recordId;

                    //    form diye delete krte chile
                    //    $('#confirmDeleteForm').submit();

                }
            });
        });
    </script>
    <script>
        $('#codeCheck').keyup(function() {
            var code = $(this).val();
            $.ajax({
                type: 'post',
                url: "{{ route('product-code-exist-check') }}",
                data: {
                    code: code
                },
                success: function(resp) {
                    if (resp == 'true') {
                        $('#codeExistMessage').html('This Product code is already exists.!!');
                    } else {
                        $('#codeExistMessage').html('');
                    }
                }
            });
        });
    </script>
    <script>
            $('#summernote').summernote();
            $('.summernote').summernote();
    </script>
@endsection
