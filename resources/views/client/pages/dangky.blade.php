@extends('client.layout.master')

@section('content')
    <section>
        <div class="container">
           
            <form action="{{ route('nguoidung.dangky') }}" method="POST" class="form-signin auth">
                {{-- @if($errors->any())
                <div>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li style="color:red;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif   --}}
                @csrf
                <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt=""
                    width="72" height="72">
                <h1 class="h3 mb-3 font-weight-normal">Sign up</h1>
                <label for="inputEmail" class="sr-only">Name</label>
                <input name="name" type="text" id="inputEmail" class="form-control" placeholder="Name" required autofocus value="{{ old('name') }}">
                @error('name')
                    <p style="color:red;">{{ $message }}</p>
                @enderror

                <label for="inputEmail" class="sr-only">Email address</label>
                <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus value="{{ old('email') }}">
                @error('email')
                    <p style="color:red;">{{ $message }}</p>
                @enderror

                <label for="inputPassword" class="sr-only">Password</label>
                <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                @error('password')
                    <p style="color:red;">{{ $message }}</p>
                @enderror

                <div class="checkbox mb-3">
                    {{-- <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label> --}}
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
                {{-- <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p> --}}
            </form>
        </div>
    </section>
@endsection
