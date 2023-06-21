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
                                        <label>Status</label>
                                        <select class="form-control">
                                        <option>--- Please select ---</option>
                                        <option value="1">Show</option>
                                        <option value="0">Hide</option>
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
