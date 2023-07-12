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
                        <a href={{ route('admin.product.create') }} type="button" class="btn btn-primary">Create
                            product</a>
                        <div class="card mt-3">
                            <div class="card-header">
                                <div class="col-8">
                                    <form class="row" method="GET" action="">
                                        <input name="keyword" type="text" class="form-control col-6"
                                            placeholder="Search...">
                                        <select name="status" class="form-control col-2">
                                            <option value="">All</option>
                                            <option value="1">show</option>
                                            <option value="0">hide</option>
                                        </select>
                                        <select name="sort" class="form-control col-2">
                                            <option value="0">Lasted</option>
                                            <option value="1">Price Low to High</option>
                                            <option value="2">Price High to Low</option>
                                        </select>
                                        <button type="submit" class="btn btn-block btn-primary col-2">Search</button>
                                        <div class="col-12">
                                            <p class="mb-0">
                                                <label for="amount">Price range:</label>
                                                <input type="text" id="amount" readonly
                                                    style="border:0; color:#f6931f; font-weight:bold;">
                                                <input type="hidden" id="amount_start" name="amount_start" />
                                                <input type="hidden" id="amount_end" name="amount_end" />
                                            </p>
                                            <div id="slider-range"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>

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
                                                            aria-label="Platform(s): activate to sort column ascending">
                                                            Price</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Platform(s): activate to sort column ascending">
                                                            Description</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Platform(s): activate to sort column ascending">
                                                            Category</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Platform(s): activate to sort column ascending">
                                                            Image</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Engine version: activate to sort column ascending">
                                                            Status</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Engine version: activate to sort column ascending">
                                                            Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($product as $item)
                                                        <tr class="even">
                                                            <td class="sorting_1 dtr-control">{{ $loop->iteration }}</td>
                                                            <td>{{ $item->name }}</td>
                                                            <td>{{ $item->slug }}</td>
                                                            <td>{{ $item->price }}</td>
                                                            <td>{!! $item->description !!}</td>
                                                            <td>{{ $item->category->name }}</td>
                                                            <td>{{ $item->slug }}</td>
                                                            <td>
                                                                @php
                                                                    $imageName = $item->image_url == 'empty' || !file_exists('images/' . $item->image_url) ? 'default_image.png' : $item->image_url;
                                                                @endphp
                                                                <img src="{{ asset('images/' . $imageName) }}"
                                                                    width="100px" height="100px" />
                                                            </td>
                                                            <td>
                                                                @if ($item->status)
                                                                    <span class="badge bg-success ">Show</span>
                                                                @else
                                                                    <span class="badge bg-danger">Hide</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="row">
                                                                    <a href={{ route('admin.product.show', ['product' => $item->id]) }}
                                                                        class="btn btn-block btn-primary col-12">Edit</a>
                                                                    @if ($item->deleted_at)
                                                                        <form
                                                                            action="{{ route('admin.product.restore', ['product' => $item->id]) }}"
                                                                            method="POST" class="col-12 p-0">
                                                                            @csrf
                                                                            <button onclick="return alert('Are you sure?')"
                                                                                type="submit"
                                                                                class="btn btn-block btn-success col-12">Restore</button>
                                                                        </form>
                                                                    @else
                                                                        <form class="col-12 p-0" method="POST"
                                                                            action="{{ route('admin.product.destroy', ['product' => $item->id]) }}">
                                                                            @csrf
                                                                            @method('delete')
                                                                            <button onclick="return alert('Are you sure?')"
                                                                                type="submit"
                                                                                class="btn btn-block btn-danger col-12">Delete</button>
                                                                        </form>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-12">
                                          {{ $product->appends(request()->query())->links() }}
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

@section('js-custom')
    <script>
        $(document).ready(
            function() {
                $("#slider-range").slider({
                    range: true,
                    min: 0,
                    max: {{ $maxPrice }},
                    values: [{{ request()->amount_start ?? 0 }}, {{ request()->amount_end ?? 30 }}],
                    slide: function(event, ui) {
                        $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                        $("#amount_start").val(ui.values[0]);
                        $("#amount_end").val(ui.values[1]);
                    }
                });
                $("#amount").val("$" + $("#slider-range").slider("values", 0) +
                    " - $" + $("#slider-range").slider("values", 1));
            });
    </script>
@endsection
