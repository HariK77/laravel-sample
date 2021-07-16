@extends('templates/base-layout')

@section('title', 'Gallery List')

@section('body')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Res Controllers</a></li>
                                <li class="breadcrumb-item active">Gallery List</li>
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
                            <h4 class="card-title">Gallery List</h4>
                            <hr>

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered mb-0">

                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($galleries as $gallery)
                                        <tr>
                                            <th scope="row">{{ $gallery->id }}</th>
                                            <td>{{ $gallery->category->name }}</td>
                                            <td>{{ $gallery->description }}</td>
                                            <td><img src="{{ url($gallery->file_path) }}" alt="" width="100px"></td>
                                            <td>{{ dateFormat($gallery->created_at) }}</td>
                                            <td>
                                                <a class="btn btn-info"
                                                href="{{ route('gallery.show', $gallery->id) }}"><i class="fas fa-eye"></i></a>
                                            <a class="btn btn-success"
                                                href="{{ route('gallery.edit', $gallery->id) }}"><i
                                                    class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger" href="javascript:void(0);"
                                                onclick="return confirm('Are You Sure ?') ? document.getElementById('delete{{ $gallery->id }}').submit() : '';"><i class="fas fa-trash"></i></a>
                                            <form method="POST" id="delete{{ $gallery->id }}"
                                                action="{{ route('gallery.destroy', $gallery->id) }}">
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
                                {{ $galleries->links() }}
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
