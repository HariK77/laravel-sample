@extends('templates/base-layout')

@section('title', 'Add Permission')

@section('topCss')
    <!-- select2 css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endsection

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
                            <li class="breadcrumb-item active">Add Permission</li>
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
                        <h4 class="card-title">Add Permission</h4>
                        <hr>
                        {{-- <p class="card-title-desc">Provide valuable, actionable feedback to your users with
                            HTML5 form validation–available in all our supported browsers.</p> --}}
                        <form action="{{ route('users.store') }}" method="POST">
                            {{-- class="needs-validation" novalidate --}}
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="username" placeholder="Enter username"
                                            value="{{ old('name') }}" autocomplete="name" required>
                                        @error('name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="useremail" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" id="useremail" placeholder="Enter email" autocomplete="email"
                                            required>
                                        @error('email')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="userpassword" class="form-label">Password</label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            id="userpassword" name="password" placeholder="Enter password"
                                            autocomplete="new-password" required>
                                        @error('password')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="userpasswordconfirm" class="form-label">Confirm Password</label>
                                        <input type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            id="userpasswordconfirm" name="password_confirmation"
                                            placeholder="Enter same password again" autocomplete="new-password"
                                            required>
                                        @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Select Roles</label>
                                        <select class="select2 form-control select2-multiple" name="roles[]" multiple
                                            data-placeholder="Assign Roles">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"> {{ $role->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit">Add</button>
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


@section('js')
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        $('.select2').select2();
    })
</script>

@endsection
