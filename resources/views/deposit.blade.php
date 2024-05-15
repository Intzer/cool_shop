@extends('layouts.base')

@section('header.title', __('Deposit'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3>{{ ('Make a deposit') }}</h3>
                        <div class="mb-3">
                            <label for="sum">{{ __('Sum (Byn)') }}</label>
                            <input class="form-control" id="sum" name="sum" placeholder="100">
                        </div>
                        <div class="mb-3">
                            <label for="card">{{ __('Card number') }}</label>
                            <input class="form-control" id="card" name="card" placeholder="0000 0000 0000 0000">
                        </div>
                        <div class="mb-3">
                            <label for="expired">{{ __('Card expired') }}</label>
                            <input class="form-control" id="expired" name="expired" placeholder="12/28">
                        </div>
                        <button type="button" class="btn btn-primary w-100">{{ __('Deposit') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
