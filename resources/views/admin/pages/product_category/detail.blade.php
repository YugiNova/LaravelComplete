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
                                <h3 class="card-title">Create Product Category</h3>
                            </div>
                            <form  method="POST" action={{ route('admin.product_category.update',['id'=>$productCategory->id]) }}>
                                @csrf
                                {{-- @dd($productCategory); --}}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input value="{{ $productCategory->name }}" type="text" class="form-control" name="name" id="name" placeholder="Name">
                                        @error('name')
                                            <p style="color: red">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Slug</label>
                                        <input value="{{ $productCategory->slug }}" type="text" class="form-control" name="slug" id="slug" placeholder="Slug">
                                        @error('slug')
                                            <p style="color: red">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="2">--- Please select ---</option>
                                            <option value="1" {{ $productCategory->status == 1 ? "selected" : ""}}>Show</option>
                                            <option value="0" {{ $productCategory->status == 0 ? "selected" : ""}}>Hide</option>
                                        </select>
                                        @error('status')
                                            <p style="color: red">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="id" value="{{ $productCategory->id }}"/>
                                </div>
            
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
    <script type="text/javascript">
        $( document ).ready(function() {
            $('#name').on('keyup',function(){
                let name =$(this).val();
                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.product_category.slug') }}",
                    data: {
                        name: name,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (res) {
                        $('#slug').val(res.slug);
                    }
                });
            })
        })
    </script>
@endsection