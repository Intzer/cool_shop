@extends('layouts.base')

@section('content')
    <div class="text-center d-flex align-items-center p-4">
        <main class="form-signin m-auto">
            <form>
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

                <div class="form-floating">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating my-2">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary my-2" type="submit">Sign in</button>
            </form>
        </main>
    </div>
@endsection
