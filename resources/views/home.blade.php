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
            <h1>Art Institute of Chicago API</h1>
        </div>

        @if (Auth::check())
        <div class="col-md-8">
            <passport-personal-access-tokens></passport-personal-access-tokens>
        </div>
        @endif

        <div class="col-md-8">
        @if (App::environment('production'))
            <p>Coming soon!</p>
        @else
            <p>The Art Institute of Chicago's API provides JSON formatted data as a REST-style service that allows developers to explore and integrate the museum’s data into their projects. This API is the same tool that powers our <a href="https://www.artic.edu">website</a>, our <a href="https://www.artic.edu/visit/explore-on-your-own/mobile-app-audio-tours">mobile app</a>, and many other technologies in the museum.</p>

            <h2>Getting started</h2>

            <p>API requests are made by accessing various endpoints at <a href="/api/v1">{{ config('app.url') }}/api/v1</a>. Read more about our <a href="/docs/endpoints">endpoints</a> and <a href="/docs/fields">fields</a> in our documentation to learn about the parameters you can use to manipulate your query.</p>

            <p>Most data is accessible without authentication. If you're developing a high-traffic app, you can create an account on this site to create personal tokens that can allow you to access the API more frequently.</p>

            <h2>What's an API?</h2>

            <p>An <a href="https://www.youtube.com/watch?v=81ygVYCupdo">API</a> is a structured way that one software application can talk to another. APIs power much of the software we use today, from the apps on our phones and watches to technology we see in sports and TV shows. The Art Institute of Chicago has built an API to let people like you easily get the data you need in an ongoing way.</p>

            <p>To look at all the artworks in our collection, access the API with the following URL:</p>

            <p><code>{{ config('app.url') }}/api/v1/artworks</code></p>

            <p>When you view this in your browser you might get a jumbled bunch of text. That's OK! If you're using Chrome, install the <a href="https://chrome.google.com/webstore/detail/json-formatter/bcjindcccaagfpapjjmafapmmgkkhgoa">JSON Formatter extension</a> and hit reload, and the results will be formatted in a way humans can read, too.</p>

            <p>There is a lot of data you'll get for each artwork. If you want to only retrieve a certain set of fields, change the `fields` parameter in the query to list which ones you want, like this:</p>

            <p><code>{{ config('app.url') }}/api/v1/artworks?fields=id,title,artist_display,date_display,main_reference_number</p></code>

            <p>There's a lot of information you can get in our collection, and there's a lot more than artworks in our API. Learn more by reading through our <a href="/docs/endpoints">endpoints</a> and <a href="/docs/fields">fields</a> documentation.</p>

            <p>If the application you're building will be public, please send it our way! We'd love to share it alongside some of the other projects that use our API. And if you have any questions, please feel free to reach out to us: engineering@artic.edu.</p>

            <h2>Authenticate requests</h2>

            <p>Developers of high-traffic apps may want to authenticate their requests to access the API at a greater frequency. Anonymous users can access the API 60 times per minute. Authenticated requests are given a much high threshold.</p>

            <p>First, <a href="/register">register</a> an account on our site. Then on the homepage, you'll be given an option to create personal access tokens to authenticate your requests. You can make as many tokens as you wish. We recommend one per application.</p>

            <p>To make the same call as above with your personal access token, you can pass it in the header of your request. This is how it would look on the command line:</p>

            <pre><code>curl -v -X GET {{ config('app.url') }}/api/v1/artworks?fields=id,title,artist_display,date_display,main_reference_number \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer {Put your access token here}"</code></pre>

            <p>If you're using this method to access our API, each of your requests should be made in this way.</p>
        @endif
        </div>

    </div>
</div>
@endsection
