@extends('admin.layout.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Main row -->
                <div class="row">
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->
                    <section class="col-lg-12 connectedSortable">
                        <a href={{ route('admin.product_category.create') }} type="button" class="btn btn-primary">Create
                            product category</a>
                        <div class="card mt-3">
                            {{-- <div class="card-header">
                                <h3 class="card-title">DataTable with minimal features &amp; hover style</h3>
                            </div> --}}

                            <div class="card-body">
                                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6"></div>
                                        <div class="col-sm-12 col-md-6"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="example2"
                                                class="table table-bordered table-hover dataTable dtr-inline"
                                                aria-describedby="example2_info">
                                                <thead>
                                                    <tr>
                                                        <th class="sorting sorting_asc" tabindex="0"
                                                            aria-controls="example2" rowspan="1" colspan="1"
                                                            aria-sort="ascending"
                                                            aria-label="Rendering engine: activate to sort column descending">
                                                            #</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Browser: activate to sort column ascending">Name
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Platform(s): activate to sort column ascending">
                                                            Slug</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Engine version: activate to sort column ascending">
                                                            Status</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Engine version: activate to sort column ascending">
                                                            Products Count</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Engine version: activate to sort column ascending">
                                                            Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($productCategory as $item)
                                                        <tr class="even">
                                                            <td class="sorting_1 dtr-control">{{ $loop->iteration }}</td>
                                                            <td>{{ $item->name }}</td>
                                                            <td>{{ $item->slug }}</td>
                                                            <td>
                                                                @if ($item->status)
                                                                    <span class="badge bg-success ">Show</span>
                                                                @else
                                                                    <span class="badge bg-danger">Hide</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $item->products->count() }}</td>
                                                            <td>
                                                              <div class="row w-100">
                                                                <form class="row w-100" method="POST" action="{{ route('admin.product_category.delete',['id'=>$item->id]) }}">
                                                                    @csrf
                                                                    <a href={{ route('admin.product_category.detail',['id'=>$item->id]) }} class="btn btn-block btn-primary col-3 mr-5">Edit</a>
                                                                    <button type="submit" class="btn btn-block btn-danger col-3 mt-0">Delete</button>
                                                                </form>
                                                              </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>      
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5">
                                            <div class="dataTables_info" id="example2_info" role="status"
                                                aria-live="polite">Showing 1 to 10 of 57 entries</div>
                                        </div>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                                <ul class="pagination">
                                                    <li class="paginate_button page-item previous disabled"
                                                        id="example2_previous"><a href="#" aria-controls="example2"
                                                            data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                                    </li>
                                                    {{-- @for($page = 1;$page <= $numberOfPage; $page++)
                                                        <li class="paginate_button page-item"><a href="?page={{ $page }}"
                                                            aria-controls="example2" data-dt-idx="1" tabindex="0"
                                                            class="page-link">{{ $page }}</a></li>
                                                    @endfor --}}
                                                    {{ $productCategory->links() }}
                                                    
                                                    {{-- <li class="paginate_button page-item "><a href="#"
                                                            aria-controls="example2" data-dt-idx="2" tabindex="0"
                                                            class="page-link">2</a></li>
                                                    <li class="paginate_button page-item "><a href="#"
                                                            aria-controls="example2" data-dt-idx="3" tabindex="0"
                                                            class="page-link">3</a></li>
                                                    <li class="paginate_button page-item "><a href="#"
                                                            aria-controls="example2" data-dt-idx="4" tabindex="0"
                                                            class="page-link">4</a></li>
                                                    <li class="paginate_button page-item "><a href="#"
                                                            aria-controls="example2" data-dt-idx="5" tabindex="0"
                                                            class="page-link">5</a></li>
                                                    <li class="paginate_button page-item "><a href="#"
                                                            aria-controls="example2" data-dt-idx="6" tabindex="0"
                                                            class="page-link">6</a></li> --}}
                                                    <li class="paginate_button page-item next" id="example2_next"><a
                                                            href="#" aria-controls="example2" data-dt-idx="7"
                                                            tabindex="0" class="page-link">Next</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </section>
                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
