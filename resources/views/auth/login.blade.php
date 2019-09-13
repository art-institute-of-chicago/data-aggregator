@extends('layouts.app')

@section('content')
        <header class="m-article-header">
            <div class="m-article-header__text">
                <h1 class="title f-headline" itemprop="name">{{ __('Login') }}</h1>
            </div>
        </header>

        <div class="o-article__primary-actions"></div>
        <div class="o-article__secondary-actions"></div>

        <div class="o-article__body o-blocks">
            <form class="o-form o-blocks o-blocks__block" method="POST" action="{{ route('login') }}">
                @csrf

                <fieldset class="m-fieldset">
                    <ol class="m-fieldset__fields">
                        <li class="m-fieldset__field o-blocks">
                            <span class="input s-disabled">
                                <label for="email" class="label f-secondary">{{ __('E-Mail Address') }}</label>
                                <input class="f-secondary {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" value="{{ old('email') }}" id="email" name="email" placeholder="" required autofocus>
                                @if ($errors->has('email'))
                                    <em class="error-msg f-secondary">{{ $errors->first('email') }}</em>
                                @endif
                            </span>
                        </li>

                        <li class="m-fieldset__field o-blocks">
                            <span class="input s-disabled">
                                <label for="password" class="label f-secondary">{{ __('Password') }}</label>
                                <input class="f-secondary {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" value="{{ old('password') }}" id="password" name="password" placeholder="" required>
                                @if ($errors->has('email'))
                                    <em class="error-msg f-secondary">{{ $errors->first('password') }}</em>
                                @endif
                            </span>
                        </li>

                        <li class="m-fieldset__field o-blocks m-fieldset__field--group">
                            <span class="checkbox s-disabled">
                                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class="f-secondary">
                                    <label for="remember" class="label  ">{{ __('Remember Me') }}</label>
                                </span>
                            </span>
                        </li>
                    </ol>
                </fieldset>

                <ul class="o-form__actions">
                    <li class="o-form__action">
                        <button class="btn f-buttons" type="submit">{{ __('Login') }}</button>
                    </li>
                    @if (Route::has('password.request'))
                        <li class="o-form__action">
                            <a class="btn btn--secondary f-buttons" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </li>
                    @endif
                </ul>
            </form>
        </div>
@endsection
