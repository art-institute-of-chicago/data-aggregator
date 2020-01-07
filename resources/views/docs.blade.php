@extends('layouts.app')

@section('content')

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

<div class="o-article__primary-actions">
    {!! $leftSidebar !!}
</div>
<div class="o-article__secondary-actions"></div>

<div class="o-article__body o-blocks">
    {!! $content !!}
</div>

@endsection
