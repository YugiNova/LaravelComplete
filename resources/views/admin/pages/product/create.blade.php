@extends('admin.layout.master')

@section('content')
    <section>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card card-primary mt-5">
                            <div class="card-header">
                                <h3 class="card-title">Create Product</h3>
                            </div>
                            <form>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Slug</label>
                                        <input type="text" class="form-control" id="slug" placeholder="Slug">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Price</label>
                                        <input type="number" class="form-control" id="price" placeholder="Price">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Discount</label>
                                        <input type="number" class="form-control" id="discount" placeholder="Discount">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Short Desciption</label>
                                        <input type="text" class="form-control" id="short_description" placeholder="Short Desciption">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Description</label>
                                        <input type="text" class="form-control" id="description" placeholder="Description">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Quantity</label>
                                        <input type="number" class="form-control" id="quantity" placeholder="Quantity">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Shipping</label>
                                        <input type="text" class="form-control" id="shipping" placeholder="Shipping">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Weight</label>
                                        <input type="number" class="form-control" id="weight" placeholder="Weight">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Information</label>
                                        <input type="text" class="form-control" id="information" placeholder="Information">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Active</label>
                                    </div>
                                </div>
            
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
    
    
                
            </div>
        </div>
        
    </section>
@endsection
