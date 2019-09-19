@extends('layouts.app')

@section('content')
        <header class="m-article-header">
            <div class="m-article-header__text">
                <h1 class="title f-headline" itemprop="name">{{ __('Register') }}</h1>
            </div>
        </header>

        <div class="o-article__primary-actions"></div>
        <div class="o-article__secondary-actions"></div>

        <div class="o-article__body o-blocks">
            <form class="o-form o-blocks o-blocks__block" method="POST" action="{{ route('register') }}">
                @csrf

                <fieldset class="m-fieldset">
                    <ol class="m-fieldset__fields">
                        <li class="m-fieldset__field o-blocks">
                            <span class="input s-disabled">
                                <label for="email" class="label f-secondary">{{ __('Name') }}</label>
                                <input class="f-secondary {{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" value="{{ old('name') }}" id="name" name="name" placeholder="" required autofocus>
                                @if ($errors->has('name'))
                                    <em class="error-msg f-secondary">{{ $errors->first('name') }}</em>
                                @endif
                            </span>
                        </li>

                        <li class="m-fieldset__field o-blocks">
                            <span class="input s-disabled">
                                <label for="email" class="label f-secondary">{{ __('E-Mail Address') }}</label>
                                <input class="f-secondary {{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" value="{{ old('email') }}" id="email" name="email" placeholder="" required>
                                @if ($errors->has('email'))
                                    <em class="error-msg f-secondary">{{ $errors->first('email') }}</em>
                                @endif
                            </span>
                        </li>

                        <li class="m-fieldset__field o-blocks">
                            <span class="input s-disabled">
                                <label for="password" class="label f-secondary">{{ __('Password') }}</label>
                                <input class="f-secondary {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" id="password" name="password" placeholder="" required>
                                @if ($errors->has('password'))
                                    <em class="error-msg f-secondary">{{ $errors->first('password') }}</em>
                                @endif
                            </span>
                        </li>

                        <li class="m-fieldset__field o-blocks">
                            <span class="input s-disabled">
                                <label for="password-confirm" class="label f-secondary">{{ __('Confirm Password') }}</label>
                                <input class="f-secondary {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" type="password" id="password-confirm" name="password_confirmation" placeholder="" required>
                                @if ($errors->has('password_confirmation'))
                                    <em class="error-msg f-secondary">{{ $errors->first('password_confirmation') }}</em>
                                @endif
                            </span>
                        </li>
                    </ol>
                </fieldset>

                <ul class="o-form__actions">
                    <li class="o-form__action">
                        <button class="btn f-buttons" type="submit">{{ __('Register') }}</button>
                    </li>
                </ul>
            </form>
        </div>
@endsection
