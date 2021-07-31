@extends('templates/base-layout')

@section('title', 'Update Permission - ' . $permission->name )

@section('body')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Access Management</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Permissions</a></li>
                            <li class="breadcrumb-item active">Update Permission</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Permission</h4>
                        <hr>
                        {{-- <p class="card-title-desc">Provide valuable, actionable feedback to your users with
                            HTML5 form validation–available in all our supported browsers.</p> --}}
                        <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                            {{-- class="needs-validation" novalidate --}}
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Enter Category Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                            placeholder="Enter category name" value="{{ $permission->name ?? old('name') }}" required>
                                        @error('name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection
