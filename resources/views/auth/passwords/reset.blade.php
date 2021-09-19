@extends('templates/auth-layout')

@section('title', 'Set New Password')

@section('body')


<div class="col-md-8 col-lg-6 col-xl-5">
    <div class="card overflow-hidden">
        <div class="bg-primary bg-soft">
            <div class="row">
                <div class="col-7">
                    <div class="text-primary p-4">
                        <h5 class="text-primary"> Set New Password</h5>
                        {{-- <p>Re-Password with Laravel Sample.</p> --}}
                    </div>
                </div>
                <div class="col-5 align-self-end">
                    <img src="{{ asset('assets/images/profile-img.png') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="card-body pt-0">
            <div>
                <a href="index.html">
                    <div class="avatar-md profile-user-wid mb-4">
                        <span class="avatar-title rounded-circle bg-light">
                            <img src="{{ asset('assets/images/logo.svg') }}" alt="" class="rounded-circle" height="34">
                        </span>
                    </div>
                </a>
            </div>

            <div class="p-2">
                @include('templates.includes.messages')
                <form class="form-horizontal" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="new-password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="new-password" name="password" placeholder="Enter password" autocomplete="new-password"
                            required>
                        @error('password')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="confirm-password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                            id="confirm-password" name="password_confirmation" placeholder="Enter same password as above"
                            autocomplete="new-password" required>
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="text-start">
                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
    <div class="mt-5 text-center">
        {{-- <p>Remember It ? <a href="{{ route('login') }}" class="fw-medium text-primary"> Sign In here</a> </p> --}}
        <p>© <script>
                document.write(new Date().getFullYear())
            </script> Laravel Sample. Crafted with <i class="mdi mdi-heart text-danger"></i> by Laravel Sample</p>
    </div>

</div>

@endsection
