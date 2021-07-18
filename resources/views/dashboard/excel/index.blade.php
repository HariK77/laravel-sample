@extends('templates/base-layout')

@section('title', 'Excel Operations')

@section('body')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Excel Operations</a></li>
                                <li class="breadcrumb-item active">Product List</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    @include('templates.includes.messages')
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Product List</h4>
                            <hr>

                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{ route('excel.export') }}" class="btn btn-primary">Export Excel</a> <br>
                                    <br>
                                    <a href="{{ route('excel.export-multiple-sheets') }}" class="btn btn-primary">Export
                                        With Sheets</a>
                                </div>
                                <div class="col-md-6">
                                    <form action="{{ route('excel.import') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-3 col-form-label">Upload Excel</label>
                                            <div class="col-sm-6">
                                                    <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" id="fileOne">
                                                    @error('file')
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                <div class="text-danger pt-1">*Note : Please upload .xlsx files only </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light mr-1">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form action="{{ route('excel.import-multiple-sheets') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-3 col-form-label">Upload Excel With Multi Sheets</label>
                                            <div class="col-sm-6">
                                                    <input type="file" class="form-control @error('file') is-invalid @enderror" name="file_two" id="fileTwo">
                                                    @error('file_two')
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                <div class="text-danger pt-1">*Note : Please upload .xlsx files only </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light mr-1">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-md-2">
                                    @if (session('import_stats'))
                                    <!--  modal toggle button -->
                                    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                                        data-bs-target=".import-modal">Upload Stats</button>
                                    <!--  Modal content for the above example -->
                                    <div id="errorsModal" class="modal fade import-modal" tabindex="-1" role="dialog"
                                        aria-labelledby="modalOne" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title mt-0" id="modalOne">Single Sheet Upload Stats</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-md-12">
                                                        <h6 class="text-success">Successful Things</h6>
                                                        <hr>
                                                        <div class="font-weight-bold">
                                                            @if (session('import_stats')[0] == 1)
                                                            <p>{{ session('import_stats')[0] }} &nbsp;row has been successfully
                                                                inserted !!</p>
                                                            @else
                                                            <p>{{ session('import_stats')[0] }} &nbsp;rows has been successfully
                                                                inserted !!</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h6 class="text-danger">Failed Things</h6>
                                                        <hr>
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-hover table-sm">
                                                                <thead class="thead-dark">
                                                                    <tr>
                                                                        <th>Row No</th>
                                                                        <th>Column Name</th>
                                                                        <th>Errors</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach (session('import_stats')[1] as $failure)
                                                                    <tr>
                                                                        <td>{{ $failure->row() }}</td>
                                                                        <td>{{ $failure->attribute() }}</td>
                                                                        <td>{{ $failure->errors()[0] }}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="text-primary">
                                                            <p><span class="font-weight-bold">Note :</span> You can see these errors
                                                                by clicking Upload Stats Button </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                    @endif

                                    @if (session('import_multi_stats'))
                                    <br><br><br>
                                    <!--  modal toggle button -->
                                    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                                        data-bs-target=".multi-stats-modal">Upload Stats</button>
                                    <!--  Modal content for the above example -->
                                    <div id="errorsModalMultiple" class="modal fade multi-stats-modal" tabindex="-1" role="dialog"
                                        aria-labelledby="modalTwo" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title mt-0" id="modalTwo">Multiple Sheets Upload Stats</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-md-12">
                                                        <h6 class="text-success">Successful Things</h6>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="font-weight-bold">
                                                                    @if (session('import_multi_stats')[0]['Sheet1'] == 1)
                                                                    <p>{{ session('import_multi_stats')[0]['Sheet1'] }} &nbsp;row
                                                                        has been successfully inserted from Sheet1.</p>
                                                                    @else
                                                                    <p>{{ session('import_multi_stats')[0]['Sheet1'] }} &nbsp;rows
                                                                        has been successfully inserted from Sheet1.</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="font-weight-bold">
                                                                    @if (session('import_multi_stats')[0]['Sheet2'] == 1)
                                                                    <p>{{ session('import_multi_stats')[0]['Sheet2'] }} &nbsp;row
                                                                        has been successfully inserted from Sheet2.</p>
                                                                    @else
                                                                    <p>{{ session('import_multi_stats')[0]['Sheet2'] }} &nbsp;rows
                                                                        has been successfully inserted from Sheet2.</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-12">
                                                        <h6 class="text-danger">Failed Things</h6>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered table-hover table-sm">
                                                                        <thead class="thead-dark">
                                                                            <tr>
                                                                                <th>Row No</th>
                                                                                <th>Column Name</th>
                                                                                <th>Errors</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @if (count(session('import_multi_stats')[1]['Sheet1'])
                                                                            != 0)
                                                                            @foreach (session('import_multi_stats')[1]['Sheet1'] as
                                                                            $failure)
                                                                            <tr>
                                                                                <td>{{ $failure->row() }}</td>
                                                                                <td>{{ $failure->attribute() }}</td>
                                                                                <td>{{ $failure->errors()[0] }}</td>
                                                                            </tr>
                                                                            @endforeach
                                                                            @else
                                                                            <tr>
                                                                                <td colspan="3" class="text-center">
                                                                                    No Errors found in Sheet 1.
                                                                                </td>
                                                                            </tr>
                                                                            @endif

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered table-hover table-sm">
                                                                        <thead class="thead-dark">
                                                                            <tr>
                                                                                <th>Row No</th>
                                                                                <th>Column Name</th>
                                                                                <th>Errors</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @if (count(session('import_multi_stats')[1]['Sheet2'])
                                                                            != 0)
                                                                            @foreach (session('import_multi_stats')[1]['Sheet2'] as
                                                                            $failure)
                                                                            <tr>
                                                                                <td>{{ $failure->row() }}</td>
                                                                                <td>{{ $failure->attribute() }}</td>
                                                                                <td>{{ $failure->errors()[0] }}</td>
                                                                            </tr>
                                                                            @endforeach
                                                                            @else
                                                                            <tr>
                                                                                <td colspan="3" class="text-center">
                                                                                    No Errors found in Sheet 2.
                                                                                </td>
                                                                            </tr>
                                                                            @endif

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="text-primary">
                                                            <p><span class="font-weight-bold">Note :</span> You can see these errors
                                                                by clicking Upload Stats Button </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                    @endif
                                </div>


                            </div>
                            <hr>

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered mb-0">

                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Brand</th>
                                            <th>Price</th>
                                            <th>Model Name</th>
                                            <th>Description</th>
                                            <th>Featured</th>
                                            <th>Availability</th>
                                            <th>Status (Active)</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                        <tr>
                                            <th scope="row">{{ $product->id }}</th>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->brand }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->model_name }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>{{ $product->featured }}</td>
                                            <td>{{ $product->available }}</td>
                                            <td>{{ $product->active_flag }}</td>
                                            <td>{{ dateFormat($product->created_at) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="text-center mt-2">
                                {{-- 'templates.includes.pagination' --}}
                                {{ $products->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection


@section('js')
<script>
    $(document).ready(function () {

        // modal's toggling when errors are present
        @if(session('import_stats'))
            $('#errorsModal').modal('toggle');
        @endif

        @if(session('import_multi_stats'))
            $('#errorsModalMultiple').modal('toggle');
        @endif


    });

</script>

@endsection
