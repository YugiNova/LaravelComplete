@extends('client.layout.master')

@section('content')
    <section>
        <div class="container">
            <form action="{{ route('nguoidung.dangnhap') }}" method="POST" class="form-signin auth">
                @csrf   
                <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt=""
                    width="72" height="72">
                <h1 class="h3 mb-3 font-weight-normal">Sign in</h1>
                <label for="inputEmail" class="sr-only">Email address</label>
                <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <div class="checkbox mb-3">
                    {{-- <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label> --}}
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                <p class="mt-3 mb-0 text-muted">You don't have account? <a href="#">Register</a></p>
            </form>
        </div>
    </section>
@endsection
