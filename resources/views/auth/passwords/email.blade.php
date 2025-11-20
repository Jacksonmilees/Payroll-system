@extends('layouts.app')

@push('styles')
<style>
    .reset-stage {
        min-height: 100vh;
        padding: 48px 20px;
        background: radial-gradient(circle at 15% 20%, rgba(99, 102, 241, 0.35), transparent 50%),
                    radial-gradient(circle at 80% 10%, rgba(14, 165, 233, 0.25), transparent 55%),
                    #030617;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .reset-card {
        width: 100%;
        max-width: 620px;
        padding: 52px 48px;
        border-radius: 28px;
        background: rgba(6, 10, 24, 0.85);
        border: 1px solid rgba(255, 255, 255, 0.08);
        color: #e2e8f0;
        box-shadow: 0 25px 70px rgba(3, 7, 18, 0.7);
        position: relative;
        overflow: hidden;
    }
    .reset-card::after {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: inherit;
        background: url('{{ asset('images/Background.jpg') }}') center/cover no-repeat;
        opacity: 0.08;
        mix-blend-mode: screen;
        pointer-events: none;
    }
    .reset-card__body {
        position: relative;
        z-index: 1;
    }
    .reset-pill {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 6px 16px;
        border-radius: 999px;
        background: rgba(148, 163, 184, 0.12);
        border: 1px solid rgba(148, 163, 184, 0.3);
        letter-spacing: 0.3em;
        text-transform: uppercase;
        font-size: 11px;
        color: rgba(226, 232, 240, 0.85);
    }
    .reset-card__body h1 {
        margin: 22px 0 10px;
        font-size: 2rem;
        font-weight: 600;
        color: #f8fafc;
    }
    .reset-card__body p {
        color: rgba(226, 232, 240, 0.85);
        margin-bottom: 30px;
    }
    .reset-form label {
        display: block;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 12px;
        color: rgba(226, 232, 240, 0.8);
    }
    .reset-form input {
        width: 100%;
        border-radius: 18px;
        border: 1px solid rgba(148, 163, 184, 0.4);
        background: rgba(15, 23, 42, 0.75);
        color: #f8fafc;
        padding: 14px 18px;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .reset-form input:focus {
        border-color: rgba(99, 102, 241, 0.9);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.25);
        outline: none;
    }
    .reset-btn {
        width: 100%;
        border-radius: 18px;
        padding: 14px;
        font-weight: 600;
        font-size: 1rem;
        margin-top: 28px;
        background: linear-gradient(135deg, #4c6ef5, #8b5cf6);
        border: none;
        color: #fff;
        box-shadow: 0 20px 35px rgba(76, 110, 245, 0.35);
    }
    .reset-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 22px;
        text-decoration: none;
        font-weight: 500;
        color: #a5b4fc;
    }
    .reset-alert {
        padding: 12px 16px;
        border-radius: 14px;
        background: rgba(34, 197, 94, 0.15);
        border: 1px solid rgba(34, 197, 94, 0.25);
        color: #bbf7d0;
        margin-bottom: 20px;
        font-weight: 500;
    }
    .reset-error {
        display: block;
        margin-top: 10px;
        color: #fecaca;
        font-size: 0.9rem;
    }
    @media (max-width: 640px) {
        .reset-card {
            padding: 36px 28px;
        }
    }
</style>
@endpush

@section('content')
<div class="reset-stage">
    <div class="reset-card">
        <div class="reset-card__body">
            <span class="reset-pill">
                <svg width="8" height="8" viewBox="0 0 8 8" fill="#34d399" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="4" cy="4" r="4"/>
                </svg>
                {{ __('SECURE RESET') }}
            </span>
            <h1>{{ __('Need a fresh password?') }}</h1>
            <p>{{ __('Enter the email linked to your workspace and we will send a magic reset link right away.') }}</p>

            @if (session('status'))
                <div class="reset-alert">
                    {{ session('status') }}
                </div>
            @endif

            <form class="reset-form" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

                <label for="email">{{ __('Email address') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="reset-error">
                        {{ $errors->first('email') }}
                    </span>
                @endif

                <button type="submit" class="reset-btn">
                    {{ __('Send reset link') }}
                </button>
            </form>

            <a class="reset-link" href="{{ route('login') }}">
                ← {{ __('Return to sign in') }}
            </a>
        </div>
    </div>
</div>
@endsection
