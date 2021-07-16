@extends('templates/base-layout')

@section('title', 'Add Gallery')

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
                            <li class="breadcrumb-item active">Add Gallery</li>
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
                        <h4 class="card-title">Add Gallery</h4>
                        <hr>
                        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="file" class="form-label">Upload Image</label>
                                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" id="file">
                                        @error('file')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Select Category</label>
                                        <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                                            <option selected value="">Select</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Enter Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3"></textarea>
                                        @error('description')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <img id="image_preview" class="img-fluid" src="{{ asset('assets/images/no_image.png') }}" alt="uploaded image" >
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

<script>

    const inputFile = document.getElementById('file');
    const imagePreview = document.getElementById('image_preview');

    inputFile.addEventListener('change', function (event) {
        const [file] = inputFile.files;
        if (file) {
            imagePreview.src = URL.createObjectURL(file);
        } else {
            imagePreview.src = "{{ asset('assets/images/no_image.png') }}";
        }
    })


</script>

@endsection
