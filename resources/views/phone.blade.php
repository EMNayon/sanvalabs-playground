@extends('layouts.app')

@section('title', 'Phone Validator')

@section('content')
    <div class="page-head">
        <span class="pill">sanvalabs/bd-phone-validator</span>
        <h1>BD Phone Validator</h1>
        <p>Validate a Bangladeshi mobile number with the <code>ValidBdPhone</code> rule and see what the <code>BdPhone</code> facade returns.</p>
    </div>

    <div class="grid-2">
        <form method="POST" action="/phone" class="card">
            @csrf

            <div class="field">
                <label for="phone">Mobile number</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                       placeholder="01712345678" autocomplete="off" inputmode="tel" autofocus
                       @class(['input', 'mono', 'invalid' => $errors->has('phone')])>
                @error('phone')
                    <p class="error-text bn">{{ $message }}</p>
                @enderror
                <div class="chips">
                    @foreach (['01712345678', '+880 1812-345678', '8801912345678', '01512345678', '12345', '01212345678'] as $sample)
                        <button type="button" class="chip" data-target="phone" data-fill="{{ $sample }}">{{ $sample }}</button>
                    @endforeach
                </div>
            </div>

            <div class="field">
                <span class="legend">Allowed operators <span class="hint">· none selected = all</span></span>
                <div class="options">
                    @foreach ($operators as $operator)
                        <label class="option">
                            <input type="checkbox" name="operators[]" value="{{ $operator }}"
                                   @checked(in_array($operator, old('operators', [])))>
                            <span>{{ $operator }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="field">
                <span class="legend">Error message language</span>
                <div class="options">
                    <label class="option">
                        <input type="radio" name="lang" value="en" @checked(old('lang', 'en') === 'en')>
                        <span>English</span>
                    </label>
                    <label class="option">
                        <input type="radio" name="lang" value="bn" @checked(old('lang') === 'bn')>
                        <span class="bn">বাংলা</span>
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-block">Validate</button>
        </form>

        <section class="card">
            <h2>Result</h2>

            @if (session('result'))
                @php($result = session('result'))
                <div class="alert alert-success">✓ Valid Bangladeshi mobile number</div>
                <dl class="kv">
                    <dt>Input</dt>
                    <dd class="mono">{{ $result['input'] }}</dd>
                    <dt>Operator</dt>
                    <dd><span class="badge">{{ $result['operator'] }}</span></dd>
                    <dt>Normalized</dt>
                    <dd class="mono">{{ $result['normalized'] }}</dd>
                    <dt>International</dt>
                    <dd class="mono">{{ $result['international'] }}</dd>
                </dl>
            @elseif ($errors->has('phone'))
                <div class="alert alert-error">✗ Validation failed</div>
            @else
                <p class="lead">Enter a number and press <strong>Validate</strong>.</p>
            @endif

            <h2 style="margin-top: 24px">Operator prefixes</h2>
            <p class="lead">From <code>config('bd-phone.operators')</code></p>
            <table>
                <tr><th>Prefix</th><th>Operator</th></tr>
                @foreach (config('bd-phone.operators') as $prefix => $operator)
                    <tr><td class="mono">{{ $prefix }}</td><td>{{ $operator }}</td></tr>
                @endforeach
            </table>
        </section>
    </div>
@endsection
