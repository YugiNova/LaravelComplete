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
                            <form method="POST" action={{ route('admin.product.update',['product'=>$product->id]) }} enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input value="{{ $product->name }}"  type="text" class="form-control" name="name" id="name"
                                            placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Slug</label>
                                        <input value="{{ $product->slug }}" type="text" class="form-control" name="slug" id="slug"
                                            placeholder="Slug">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Price</label>
                                        <input value="{{ $product->price }}" type="number" class="form-control" name="price" id="price"
                                            placeholder="Price">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Discount</label>
                                        <input  value="{{ $product->discount_price }}" type="number" class="form-control" name="discount_price" id="discount"
                                            placeholder="Discount">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Short Desciption</label>
                                        <input value="{{ $product->short_desscription }}" type="text" class="form-control" name="short_desscription"
                                            id="short_description" placeholder="Short Desciption">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Description</label>
                                        <textarea  id="description" name="description">{!!  $product->description !!}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Quantity</label>
                                        <input value="{{ $product->qty }}" type="number" class="form-control" name="qty" id="qty"
                                            placeholder="Quantity">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Shipping</label>
                                        <input value="{{ $product->shipping }}" type="text" class="form-control" name="shipping" id="shipping"
                                            placeholder="Shipping">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Weight</label>
                                        <input value="{{ $product->weight }}" type="number" class="form-control" name="weight" id="weight"
                                            placeholder="Weight">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Information</label>
                                        <input value="{{ $product->information }}" type="text" class="form-control" name="information" id="information"
                                            placeholder="Information">
                                    </div>
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Default file input example</label>
                                        <input name="image_url" class="form-control" type="file" id="formFile">
                                      </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="2">--- Please select ---</option>
                                            <option value="1">Show</option>
                                            <option value="0">Hide</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Product category</label>
                                        <select name="product_category_id" class="form-control">
                                            <option>--- Please select ---</option>
                                            @foreach ($categoryList as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
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

@section('js-custom')
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
