@extends('layouts.app')

@push('styles')
<style>
    :root {
        --auth-accent: #4c6ef5;
        --auth-muted: #94a3b8;
        --auth-deep: #050b18;
    }
    .auth-canvas {
        min-height: 100vh;
        padding: 40px 20px;
        background: radial-gradient(circle at top, rgba(76, 110, 245, 0.18), transparent 45%),
                    radial-gradient(circle at 20% 20%, rgba(14, 165, 233, 0.14), transparent 52%),
                    var(--auth-deep);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    .auth-glow {
        position: absolute;
        width: 460px;
        height: 460px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.35), rgba(59, 130, 246, 0));
        filter: blur(0px);
        opacity: 0.8;
        z-index: 0;
    }
    .auth-glow--one { top: -120px; right: -80px; }
    .auth-glow--two { bottom: -150px; left: -80px; background: radial-gradient(circle, rgba(236, 72, 153, 0.25), rgba(236, 72, 153, 0)); }
    .login-panel {
        width: 100%;
        max-width: 1000px;
        background: rgba(8, 15, 34, 0.78);
        border-radius: 30px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 25px 70px rgba(3, 7, 18, 0.8);
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        position: relative;
        z-index: 1;
        overflow: hidden;
    }
    .login-panel__visual {
        padding: 60px 50px;
        color: #f8fafc;
        background: url('{{ asset('images/Background.jpg') }}') center/cover no-repeat;
        position: relative;
    }
    .login-panel__visual::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(5, 11, 24, 0.85), rgba(5, 11, 24, 0.4));
    }
    .visual-inner {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        gap: 18px;
        max-width: 320px;
    }
    .visual-tag {
        font-size: 12px;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 999px;
        padding: 6px 16px;
        width: max-content;
    }
    .visual-inner h1 {
        font-size: 2.2rem;
        margin: 0;
    }
    .visual-subcopy {
        color: rgba(248, 250, 252, 0.75);
        line-height: 1.6;
        font-size: 0.98rem;
    }
    .visual-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: rgba(15, 23, 42, 0.5);
        border-radius: 999px;
        font-weight: 600;
    }
    .login-panel__form {
        padding: 60px 55px;
        background: rgba(4, 7, 16, 0.65);
        backdrop-filter: blur(20px);
        color: #e2e8f0;
    }
    .form-headline span {
        font-size: 14px;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: rgba(148, 163, 184, 0.8);
    }
    .form-headline h2 {
        font-size: 2rem;
        margin: 8px 0 0;
    }
    .form-headline p {
        color: var(--auth-muted);
        margin-top: 10px;
    }
    .floating-label {
        margin-top: 28px;
    }
    .floating-label label {
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: rgba(226, 232, 240, 0.9);
        margin-bottom: 10px;
        display: block;
    }
    .floating-label input {
        width: 100%;
        border-radius: 18px;
        border: 1px solid rgba(148, 163, 184, 0.35);
        background: rgba(15, 23, 42, 0.7);
        color: #f8fafc;
        padding: 14px 18px;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .floating-label input:focus {
        border-color: rgba(76, 110, 245, 0.8);
        box-shadow: 0 0 0 4px rgba(76, 110, 245, 0.25);
        outline: none;
    }
    .form-meta {
        margin-top: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        font-size: 0.95rem;
    }
    .form-meta .checkbox label {
        color: rgba(226, 232, 240, 0.8);
    }
    .link-pill {
        border: 1px solid rgba(148, 163, 184, 0.3);
        border-radius: 999px;
        padding: 7px 16px;
        text-decoration: none;
        color: #f8fafc;
        font-weight: 500;
        background: rgba(15, 23, 42, 0.4);
        transition: border-color 0.2s ease, color 0.2s ease;
    }
    .link-pill:hover {
        border-color: rgba(76, 110, 245, 0.8);
        color: #aecbff;
    }
    .login-btn {
        margin-top: 30px;
        width: 100%;
        border-radius: 18px;
        padding: 14px;
        font-size: 1rem;
        font-weight: 600;
        letter-spacing: 0.05em;
        background: linear-gradient(135deg, #4c6ef5, #8da2fb);
        border: none;
        color: #fff;
        box-shadow: 0 20px 35px rgba(76, 110, 245, 0.38);
        transition: transform 0.2s ease;
    }
    .login-btn:hover {
        transform: translateY(-1px);
    }
    @media (max-width: 640px) {
        .login-panel__form {
            padding: 40px 25px;
        }
        .login-panel__visual {
            padding: 40px 25px;
        }
    }
</style>
@endpush

@section('content')
<div class="auth-canvas">
    <span class="auth-glow auth-glow--one"></span>
    <span class="auth-glow auth-glow--two"></span>

    <div class="login-panel">
        <div class="login-panel__visual">
            <div class="visual-inner">
                <span class="visual-tag">{{ __('Secure Access') }}</span>
                <h1>{{ __('Welcome back') }}</h1>
                <p class="visual-subcopy">{{ __('Sign in to continue managing payroll, attendance, and the people who power your company.') }}</p>
                <span class="visual-pill">
                    <svg width="8" height="8" viewBox="0 0 8 8" fill="#4ade80" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="4" cy="4" r="4"/>
                    </svg>
                    {{ __('Status: Online') }}
                </span>
            </div>
        </div>

        <div class="login-panel__form">
            <div class="form-headline">
                <span>{{ __('Access Portal') }}</span>
                <h2>{{ config('app.name', __('Payroll Suite')) }}</h2>
                <p>{{ __('Use your workspace credentials to unlock the control center.') }}</p>
            </div>
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="floating-label{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">{{ __('Email address') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="floating-label{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" name="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-meta">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember me') }}
                        </label>
                    </div>
                    <a class="link-pill" href="{{ route('password.request') }}">{{ __('Reset password') }}</a>
                </div>

                <button type="submit" class="login-btn">
                    {{ __('Sign in to dashboard') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
