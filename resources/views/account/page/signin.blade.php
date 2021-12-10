@extends('account.layout.index')
@section('title', 'Login')
@section('content')
    <div class="simple-login-form rounded-12 shadow-dark-80 bg-white">
        <h2 class="mb-3">Sign in</h2>
        <div class="pt-sm-1 pt-md-2 pb-2">
            <a href="#" class="text-gray-700 font-weight-semibold border rounded px-sm-4 py-2 d-flex align-items-center justify-content-center bg-white">
                <img src="https://fabrx.co/preview/muse-dashboard/assets/svg/icons/google-icon.svg" alt="Google" />
                <span class="ps-2 py-1 my-1 lh-sm">Sign in with Google</span>
            </a>
        </div>
        <div class="position-relative">
            <hr class="bg-gray-200 border-gray-200 opacity-100" />
            <span class="position-absolute top-0 start-50 translate-middle text-gray-600 small bg-white px-2 px-xxl-4 text-nowrap">Or sign up with email</span>
        </div>
        <form class="pt-3" method="post">
            @csrf
            <div class="mb-4 pb-md-2">
                <label class="form-label form-label-lg" for="email">Email</label>
                <input type="email" class="form-control form-control-xl" id="email" placeholder="Your email" name="email" />
                @error('email')
                <p style="color: red">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-4 pb-md-2">
                <label class="form-label form-label-lg" for="Password">Password</label>
                <input type="password" class="form-control form-control-xl" id="Password" placeholder="••••••••••••••••" name="password" />
                @error('password')
                <p style="color: red">{{$message}}</p>
                @enderror
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-xl btn-primary">Sign In</button>
            </div>
            <div class="my-3 my-sm-4 d-flex">
                <div class="form-check form-check-sm mb-0">
                    <input class="form-check-input" type="checkbox" id="gridCheck" />
                    <label class="form-check-label small text-gray-600" for="gridCheck">
                        Remember me
                    </label>
                </div>
                <a href="#" class="small text-gray-600 ms-auto mt-1">Forgot password?</a>
            </div>
            <div class="border-top border-gray-200 pt-3 pt-sm-4 text-center">
                <span class="text-gray-700">Already have an account? <a href="/account/register" class="link-primary">Sign up</a></span>
            </div>
        </form>
    </div>
@endsection
