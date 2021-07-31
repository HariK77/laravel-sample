@extends('templates/base-layout')

@section('title', 'User List')

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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                                <li class="breadcrumb-item active">User List</li>
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
                            <h4 class="card-title">User List</h4>
                            <hr>

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered mb-0">

                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>type</th>
                                            <th>Roles</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">{{ $user->id }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->type }}</td>
                                            <td>{{ str_replace(array('[',']','"'),' ', $user->roles()->pluck('name')) }}</td>
                                            <td>{{ dateFormat($user->created_at) }}</td>
                                            <td>
                                                <a class="btn btn-info"
                                                href="{{ route('users.show', $user->id) }}"><i class="fas fa-eye"></i></a>
                                            <a class="btn btn-success"
                                                href="{{ route('users.edit', $user->id) }}"><i
                                                    class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger" href="javascript:void(0);"
                                                onclick="return confirm('Are You Sure ?') ? document.getElementById('delete{{ $user->id }}').submit() : '';"><i class="fas fa-trash"></i></a>
                                            <form method="POST" id="delete{{ $user->id }}"
                                                action="{{ route('users.destroy', $user->id) }}">
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
                                {{ $users->links() }}
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
