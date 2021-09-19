@extends('templates/auth-layout')

@section('title', 'Email Verification')

@section('body')


        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card">

                <div class="bg-primary bg-soft">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-4">
                                <h5 class="text-primary">Welcome Back !</h5>
                                <p>Verify email to continue to Laravel Sample.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('templates.includes.messages')
                    <div class="p-2">
                        <div class="text-center">

                            <div class="avatar-md mx-auto">
                                <div class="avatar-title rounded-circle bg-light">
                                    <i class="bx bxs-envelope h1 mb-0 text-primary"></i>
                                </div>
                            </div>
                            <div class="p-2 mt-4">
                                <h4>Verify your email</h4>
                                <p>We have sent you verification email, Please check it</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="mt-5 text-center">
                <p>Did't receive an email ? <a class="fw-medium text-primary" href="javascript:void(0)" onclick="event.preventDefault();
                    document.getElementById('resend-form').submit();"> Resend </a> </p>

                <form class="d-inline" id="resend-form" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                </form>
                <p>© <script>document.write(new Date().getFullYear())</script> Laravel Sample. Crafted with <i class="mdi mdi-heart text-danger"></i> by Laravel Sample</p>
            </div>

        </div>

@endsection
