@extends('templates/base-layout')

@section('title', 'Profile')

@section('body')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">Profile</a></li> --}}
                            <li class="breadcrumb-item active">Profile</li>
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
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <h4 class="card-title align-self-end">Personal Information</h4>
                            <div class="ms-auto">
                                <button class="btn btn-outline-primary btn-rounded" id="edit-profile"><i
                                        class="fas fa-edit"></i></button>
                                <button class="btn btn-outline-info btn-rounded d-none" id="cancel"><i
                                    class="fas fa-window-close"></i></button>
                                <button class="btn btn-outline-success btn-rounded d-none" id="save-profile"><i
                                        class="fas fa-save"></i></button>
                            </div>
                        </div>
                        <hr>
                        {{-- <p class="text-muted mb-4">Hi I'm Cynthia Price,has been the industry's standard dummy text To
                            an English person, it will seem like simplified English, as a skeptical Cambridge.</p> --}}
                        <div class="table-responsive">
                            <table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Full Name :</th>
                                        <td>
                                            <div class="show-info">
                                                {{ auth()->user()->name }}
                                            </div>
                                            <div class="show-input-fields d-none">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Enter user name" value="{{ auth()->user()->name }}"
                                                    autocomplete="name" required>
                                                <div class="invalid-feedback">
                                                    <strong></strong>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">E-mail :</th>
                                        <td>
                                            <div class="show-info">
                                                {{ auth()->user()->email }}
                                            </div>
                                            <div class="show-input-fields d-none">
                                                <input type="email" class="form-control" name="email" id="email"
                                                    value="{{ auth()->user()->email }}" placeholder="Enter email"
                                                    autocomplete="email" required>
                                                <div class="invalid-feedback">
                                                    <strong></strong>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <h4 class="card-title align-self-end">Change Password</h4>
                        </div>
                        <hr>
                        <form method="POST" action="{{ route('update-password') }}" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                    id="current_password" name="current_password" placeholder="Enter current password"
                                    required>
                                @error('current_password')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="user-password" class="form-label">New Password</label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                    id="user-password" name="new_password" placeholder="Enter password"
                                    autocomplete="new-password" required>
                                @error('new_password')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="confirm-password" class="form-label">Confirm Password</label>
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="confirm-password" name="password_confirmation"
                                    placeholder="Enter same password as above" autocomplete="new-password" required>
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit">Change</button>
                            </div>
                        </form>
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
<script src="{{ asset('assets/plugins/axios/axios.min.js') }}"></script>
<script src="{{ asset('assets/js/axios-helper.js') }}"></script>
<script>
    const editBtn = document.querySelector('#edit-profile');
    const saveBtn = document.querySelector('#save-profile');
    const cancelBtn = document.querySelector('#cancel')

    const showInfoSections = document.querySelectorAll('.show-info');
    const showInputSections = document.querySelectorAll('.show-input-fields');

    const name = document.getElementById('name');
    const email = document.getElementById('email');

    const userId = '{{ auth()->user()->id }}';

    editBtn.addEventListener('click', () => {

        editBtn.classList.add('d-none');
        saveBtn.classList.remove('d-none');
        cancelBtn.classList.remove('d-none');

        showAndHide('edit')

    });

    cancelBtn.addEventListener('click', () => {
        showAndHide('cancel');
        editBtn.classList.remove('d-none');
        saveBtn.classList.add('d-none');
        cancelBtn.classList.add('d-none');
    })

    saveBtn.addEventListener('click', () => {
        clearErrorMessages();
        saveBtn.disabled = true;
        const params = {
            '_token': csrfToken,
            '_method': 'PATCH',
            'id': userId,
            'name': name.value,
            'email': email.value
        };

        postRequest(`${baseUrl}/profile/${userId}`, params)
        .then(res => {
            saveBtn.disabled = false;

            name.parentElement.previousElementSibling.innerHTML = name.value;
            email.parentElement.previousElementSibling.innerHTML = email.value;

            editBtn.classList.remove('d-none');
            saveBtn.classList.add('d-none');
            cancelBtn.classList.add('d-none');

            showAndHide('save');

            showMessage(res.data.message);
        })
        .catch(error => {
            saveBtn.disabled = false;
            appendErrorMessages(error.response.data);
            showMessage('validation Error', 'error');
        });

    });

    const showAndHide = action => {

        for (let index = 0; index < showInputSections.length; index++) {
            if (action === 'edit') {
                showInputSections[index].classList.remove('d-none');
                showInfoSections[index].classList.add('d-none');
            } else {
                showInputSections[index].classList.add('d-none');
                showInfoSections[index].classList.remove('d-none');
            }
        }
    }

    const clearErrorMessages = () => {
        Array.from(document.querySelectorAll('.form-select.is-invalid')).forEach((el) => el.classList.remove('is-invalid'));
        Array.from(document.querySelectorAll('.form-control.is-invalid')).forEach((el) => el.classList.remove('is-invalid'));
        return;
    }

    const appendErrorMessages = errors => {

        for(let error in errors) {
            let element = document.getElementById(error);
            element.classList.add('is-invalid');
            element.nextElementSibling.children[0].innerHTML = errors[error][0];
        }
        return;
    }
</script>
@endsection
