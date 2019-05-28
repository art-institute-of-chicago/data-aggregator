@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (session('status'))
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                </div>
            </div>
        </div>
        @endif

        <div class="col-md-8">
            <passport-personal-access-tokens></passport-personal-access-tokens>
        </div>

    </div>
</div>
@endsection
