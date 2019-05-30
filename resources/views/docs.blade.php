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
            {!! $content !!}
        </div>

    </div>
</div>
@endsection
