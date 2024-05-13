@extends('layouts.base')

@section('content')
    <div class="text-center d-flex align-items-center p-4">
        <main class="form-signin m-auto">

            @if($errors->any())
            <ul class="list-group list-group-flush">
                @foreach($errors->all() as $error)
                    <li class="list-group-item text-danger">{{ $error }}</li>
                @endforeach
            </ul>
            @endif

            <form method="post" action="{{ route('register.store') }}">
                @csrf
                <h1 class="h3 mb-3 fw-normal">Create new account</h1>
                <div class="form-floating">
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="name">
                    <label for="firstname">Name</label>
                </div>
                <div class="form-floating my-2">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                    <label for="email">Email address</label>
                </div>
                <div class="form-floating my-2">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <label for="password">Password</label>
                </div>
                <div class="form-floating my-2">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password">
                    <label for="password_confirmation">Confirm password</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary my-2" type="submit">Sign up</button>
            </form>
        </main>
    </div>
@endsection
