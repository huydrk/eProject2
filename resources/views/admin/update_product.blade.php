@extends('admin_layout')
@section('update_product')
<div class="container-fluid">
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Cập nhật thông tin sản phẩm</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="row">
        <div class="offset-md-0 col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{URL::to('/postupdateproduct')}}" method="post" >
                {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="txt-id">Id</label>
                            <input type="text" class="form-control" id="txt-id" name="id" placeholder="">
                        </div>

                        <div class="form-group">

                            <label for="txt-name">Tên sản phẩm</label>

                            <input type="text" class="form-control" id="txt-name" name="tensanpham" placeholder="Input Product Name">

                        </div>
                        <div class="form-group">
                            <label for="txt-price">Xuất sứ</label>

                            <input type="text" class="form-control" id="txt-price" name="xuatsu" placeholder="">

                        </div>

                        <div class="form-group">
                            <label for="txt-price">Thương hiệu</label>

                            <input type="text" class="form-control" id="thuonghieu" name="thuonghieu" placeholder="">

                        </div>
                        
                        <div class="form-group">
                            <label for="image">Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="images" name="images">
                                    <label class="custom-file-label" for="image">Choose Image</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txt-price">Giá gốc</label>

                            <input type="number" class="form-control" id="txt-price-old" name="priceold" placeholder="">

                        </div>
                        <div class="form-group">
                            <label for="txt-price">Giá giảm</label>

                            <input type="number" class="form-control" id="txt-price-new" name="pricenew" placeholder="">

                        </div>

                        <div class="form-group">
                            <label for="txt-price">Mô tả sản phẩm</label>

                            <textarea type="number" class="form-control" id="mota" name="mota" placeholder="Mô tả danh mục sản phẩm"></textarea>

                        </div>
                        


                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection