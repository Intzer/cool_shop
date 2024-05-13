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

            <form action="{{ route('login.store') }}" method="post">
                @csrf
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
                <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                    <label for="email">Email address</label>
                </div>
                <div class="form-floating my-2">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <label for="password">Password</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary my-2" type="submit">Sign in</button>
            </form>
        </main>
    </div>
@endsection
