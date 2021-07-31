@extends('templates/base-layout')

@section('title', 'Add Role')

@section('topCss')
<!-- select2 css -->
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/base.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css" /> --}}
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Roles</a></li>
                            <li class="breadcrumb-item active">Add Role</li>
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
                        <h4 class="card-title">Add Role</h4>
                        <hr>
                        <form action="{{ route('roles.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="role_name" class="form-label">Role Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="role_name" placeholder="Enter role name"
                                            value="{{ old('name') }}" autocomplete="name" required>
                                        @error('name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Select Permissions</label>
                                        <select class="select2 form-control" multiple name="permissions[]">
                                            @foreach ($permissions as $permission)
                                                <option value="{{ $permission->id }}"> {{ $permission->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('permissions')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
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

{{-- <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script> --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        $('.select2').select2();
          // Pass single element
        // const element = document.querySelector('.js-choice');
        // const choices = new Choices(element, {
        //     placeholderValue: 'Assign Permissions',
        //     noChoicesText: 'No Permissions are available',
        //     itemSelectText: '',
        // });
    })
</script>

@endsection
