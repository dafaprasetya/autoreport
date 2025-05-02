@extends('admin.layouts.core', ['title'=>'Login'])
@section('body')
<section class="auth bg-base d-flex flex-wrap">
    <div class="auth-left d-lg-block d-none">
    </div>
    <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
        <div class="max-w-464-px mx-auto w-100">
            <div>
                <a href="index.html" class="mb-40 max-w-290-px">
                    <img src="assets/images/logo.png" alt="">
                </a>
                <h4 class="mb-12">Login</h4>
                <p class="mb-32 text-secondary-light text-lg">Belum punya akun? hubungi IT</p>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="icon-field mb-16">
                    <span class="icon top-50 translate-middle-y">
                        <iconify-icon icon="mage:email"></iconify-icon>
                    </span>
                    <input id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus type="email" class="form-control @error('email') is-invalid @enderror h-56-px bg-neutral-50 radius-12" placeholder="Email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="position-relative mb-20">
                    <div class="icon-field">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                        </span>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror  h-56-px bg-neutral-50 radius-12" id="your-password" placeholder="Password">
                    </div>
                    <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
                </div>
                <div class="">
                    <div class="d-flex justify-content-between gap-2">
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input border border-neutral-300" type="checkbox" value="" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remeber">Remember me </label>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-primary-600 fw-medium">Forgot Password?</a>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32"> Sign In</button>

                <div class="mt-32 center-border-horizontal text-center">
                    <span class="bg-base z-1 px-4">Or sign in with</span>
                </div>
                <div class="mt-32 text-center text-sm">
                    <p class="mb-0">Don’t have an account? <a href="sign-up.html" class="text-primary-600 fw-semibold">Sign Up</a></p>
                </div>

            </form>
        </div>
    </div>
</section>
@endsection
