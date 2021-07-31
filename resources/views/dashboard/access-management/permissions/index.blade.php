@extends('templates/base-layout')

@section('title', 'Permission List')

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
                                <li class="breadcrumb-item active">Permission List</li>
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
                            <h4 class="card-title">Permission List</h4>
                            <hr>

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered mb-0">

                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Permission</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $permission)
                                        <tr>
                                            <th scope="row">{{ $permission->id }}</th>
                                            <td>{{ $permission->name }}</td>
                                            <td>{{ dateFormat($permission->created_at) }}</td>
                                            <td>
                                                <a class="btn btn-info"
                                                href="{{ route('permissions.show', $permission->id) }}"><i class="fas fa-eye"></i></a>
                                            <a class="btn btn-success"
                                                href="{{ route('permissions.edit', $permission->id) }}"><i
                                                    class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger" href="javascript:void(0);"
                                                onclick="return confirm('Are You Sure ?') ? document.getElementById('delete{{ $permission->id }}').submit() : '';"><i class="fas fa-trash"></i></a>
                                            <form method="POST" id="delete{{ $permission->id }}"
                                                action="{{ route('permissions.destroy', $permission->id) }}">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="text-center mt-2">
                                {{-- 'templates.includes.pagination' --}}
                                {{ $permissions->links() }}
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
