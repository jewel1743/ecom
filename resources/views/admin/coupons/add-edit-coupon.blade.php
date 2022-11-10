@extends('master.admin-master.master')
@section('title')
    {{ $title }}
@endsection
@section('admin-css')
    <link rel="stylesheet" href="{{ asset('/') }}admin/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}admin/dist/css/adminlte.min.css">

@endsection
@section('body')
    <div class="content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-5">
                    <div class="col-md-6">
                        <h1>{{ $title }}</h1>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    @if (Session::has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <h4>{{ Session::get('message') }}</h4>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card ">
                        <form
                            action="{{ !empty($couponData) ? route('add-edit-coupon', ['id' => $couponData->id]) :
                             route('add-edit-coupon') }}"
                            method="POST">
                            @csrf
                            <div class="card-header">
                                <h4>{{ $title }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Coupon Option</label><br />
                                    <input type="radio" name="coupon_option" {{ !empty($couponData) && $couponData->coupon_option == 'Automatic' ? 'checked' : '' }} id="automaticCoupon" value="Automatic" checked>
                                    &nbsp; Automatic
                                    <input type="radio" name="coupon_option" {{ !empty($couponData) && $couponData->coupon_option != 'Automatic' ? 'checked' : '' }} id="manualCoupon" value="Manual">&nbsp;
                                    Manual
                                </div>
                                <div class="form-group " id="couponField" style="{{ !empty($couponData) && $couponData->coupon_option != 'Automatic' ? '' : 'display: none;' }}">
                                    <label for="">Coupon Code</label>
                                    <input type="text" name="coupon_code" placeholder="Enter Coupon Code"
                                        class="form-control" value="{{ !empty($couponData) && $couponData->coupon_option != 'Automatic' ? $couponData->coupon_code : '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Coupon Type</label><br />
                                    <input type="radio" name="coupon_type" {{ !empty($couponData) && $couponData->coupon_type == 'multiple times' ? 'checked' : '' }} value="multiple times" checked> &nbsp; Multiple Times &nbsp;
                                    <input type="radio" name="coupon_type" {{ !empty($couponData) && $couponData->coupon_type == 'single times' ? 'checked' : '' }} value="single times" >&nbsp; Single Times
                                </div>
                                <div class="form-group">
                                    <label for="">Amount Type</label><br />
                                    <input type="radio" name="amount_type" {{ !empty($couponData) && $couponData->amount_type == 'percentage' ? 'checked' : '' }} value="percentage" checked> &nbsp; Percentage &nbsp;
                                    <input type="radio" name="amount_type"  {{ !empty($couponData) && $couponData->amount_type != 'percentage' ? 'checked' : '' }} value="BDT">&nbsp; BDT or $
                                </div>
                                <div class="form-group ">
                                    <label for="">Amount</label>
                                    <input type="number" name="amount" placeholder="Enter Coupon Amount" class="form-control" value="{{ !empty($couponData) ? $couponData->amount : '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Select Category</label>
                                    <select name="categories[]" class="form-control select2" multiple="multiple"
                                        data-placeholder="Select Category" required>
                                        @foreach ($sections as $section)
                                            <optgroup label="{{ $section->name }}"></optgroup>
                                            @foreach ($section->categories as $category)
                                                <option value="{{ $category->id }}" {{ in_array($category->id, $selCats) ? 'selected' : '' }}>
                                                    &nbsp;&nbsp; {{ $category->category_name }}</option>
                                                @foreach ($category->subCategory as $subCategory)
                                                    <option value="{{ $subCategory->id }}" {{ in_array($subCategory->id, $selCats) ? 'selected' : '' }}>
                                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                        &nbsp;{{ $subCategory->category_name }}</option>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Users</label>
                                    <select name="users[]" class="form-control select2" multiple="multiple"
                                        data-placeholder="Select users">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->email }}" {{ in_array($user->email, $selUsers) ? 'selected' : '' }}>{{ $user->email }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Expiry Date</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                      </div>
                                      <input type="text" class="form-control" value="{{ !empty($couponData) ? $couponData->expiry_date : '' }}" name="expiry_date" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask required>
                                    </div>
                                    <!-- /.input group -->
                                  </div>
                            </div>
                            <div class="card-footer">
                                @if (!empty($couponData))
                                    <button class="btn btn-success" type="submit">Update Coupon</button>
                                @else
                                    <button class="btn btn-success" type="submit">Add Coupon</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('admin-js')
    <script src="{{ asset('/') }}admin/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('/') }}admin/plugins/inputmask/jquery.inputmask.min.js"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            $('[data-mask]').inputmask()
        })
    </script>
    <script>
        $(document).ready(function() {
            $("#manualCoupon").click(function() {
                $("#couponField").show();
            });
            $("#automaticCoupon").click(function() {
                $("#couponField").hide();
            });
        });
    </script>
    
@endsection
