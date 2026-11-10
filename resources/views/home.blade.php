@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="page-head">
        <h1>Laravel packages for Bangladesh</h1>
        <p>Try both Sanvalabs packages live. Every result on these pages is produced by the packages themselves.</p>
    </div>

    <div class="grid-2">
        <section class="card">
            <span class="pill">sanvalabs/bangla-converter</span>
            <h2>Bangla Converter</h2>
            <p class="lead">Numbers to Bangla digits and words, dates with Bangla month and day names.</p>

            <dl class="kv" style="margin-bottom: 20px">
                <dt>Today</dt>
                <dd class="bn">{{ BanglaDate::format(now(), 'l, j F Y') }}</dd>
                <dt>{{ number_format(150000) }}</dt>
                <dd class="bn">{{ BanglaNumber::toWords(150000) }}</dd>
                <dt>2026</dt>
                <dd class="bn">{{ BanglaNumber::convert(2026) }}</dd>
            </dl>

            <p class="terminal push-bottom" style="margin-bottom: 16px">composer require sanvalabs/bangla-converter</p>
            <a href="/bangla" class="btn btn-block">Open Bangla Converter →</a>
        </section>

        <section class="card">
            <span class="pill">sanvalabs/bd-phone-validator</span>
            <h2>BD Phone Validator</h2>
            <p class="lead">Validate Bangladeshi mobile numbers, detect the operator and normalize the format.</p>

            <dl class="kv" style="margin-bottom: 20px">
                <dt>+880 1712-345678</dt>
                <dd><span class="badge">{{ BdPhone::operator('+880 1712-345678') }}</span></dd>
                <dt>Normalized</dt>
                <dd class="mono">{{ BdPhone::normalize('+880 1712-345678') }}</dd>
                <dt>01212345678</dt>
                <dd>{{ BdPhone::isValid('01212345678') ? 'Valid' : 'Invalid' }}</dd>
            </dl>

            <p class="terminal push-bottom" style="margin-bottom: 16px">composer require sanvalabs/bd-phone-validator</p>
            <a href="/phone" class="btn btn-block">Open Phone Validator →</a>
        </section>
    </div>
@endsection
