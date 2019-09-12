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

        <header class="m-article-header">
            <div class="m-article-header__text">
                <h1 class="title f-headline" itemprop="name">{{ $title }}</h1>
            </div>
        </header>

        <div class="o-article__primary-actions"></div>
        <div class="o-article__secondary-actions"></div>

        <div class="o-article__body o-blocks">
            {!! $content !!}
        </div>

@endsection
