@extends('layouts.app')

@section('title', 'Bangla Converter')

@section('content')
    <div class="page-head">
        <span class="pill">sanvalabs/bangla-converter</span>
        <h1>Bangla Converter</h1>
        <p>Type a number or pick a date. English and Bangla digits both work as input.</p>
    </div>

    <form method="GET" action="/bangla">
        <section class="card">
            <h2>Number</h2>
            <p class="lead"><code>BanglaNumber::convert()</code> and <code>BanglaNumber::toWords()</code></p>

            <div class="field">
                <div class="input-row">
                    <input class="input mono" type="text" id="number" name="number" value="{{ $number }}"
                           placeholder="1250000" autocomplete="off" inputmode="decimal">
                    <button type="submit" class="btn">Convert</button>
                </div>
                <div class="chips">
                    @foreach (['7', '125', '2026', '150000', '25000000', '12.5', '-15', '১২৫'] as $sample)
                        <button type="button" class="chip" data-target="number" data-fill="{{ $sample }}">{{ $sample }}</button>
                    @endforeach
                </div>
            </div>

            @if ($words === null)
                <div class="alert alert-error">"{{ $number }}" is not a number.</div>
            @else
                <dl class="kv">
                    <dt>Digits</dt>
                    <dd class="big">{{ $digits }}</dd>
                    <dt>Words</dt>
                    <dd class="big">{{ $words }}</dd>
                    <dt>English</dt>
                    <dd class="mono">{{ $english }}</dd>
                </dl>
            @endif
        </section>

        <section class="card">
            <h2>Date</h2>
            <p class="lead"><code>BanglaDate::format($date, $format)</code> with any PHP date format</p>

            <div class="grid-2">
                <div class="field">
                    <label for="date">Date and time</label>
                    <input class="input" type="datetime-local" id="date" name="date" value="{{ $date->format('Y-m-d\TH:i') }}">
                </div>
                <div class="field">
                    <label for="format">Format <span class="hint">(<a href="https://www.php.net/manual/en/datetime.format.php" target="_blank" rel="noopener">reference</a>)</span></label>
                    <div class="input-row">
                        <input class="input mono" type="text" id="format" name="format" value="{{ $format }}" autocomplete="off">
                        <button type="submit" class="btn">Format</button>
                    </div>
                </div>
            </div>

            <p class="big" style="margin: 0 0 20px">{{ BanglaDate::format($date, $format) }}</p>

            <div class="table-wrap">
                <table>
                    <tr><th>Format</th><th>Output</th></tr>
                    @foreach ($formats as $preset)
                        <tr>
                            <td><button type="button" class="chip" data-target="format" data-fill="{{ $preset }}">{{ $preset }}</button></td>
                            <td class="bn">{{ BanglaDate::format($date, $preset) }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </section>
    </form>

    <section class="card">
        <h2>Blade helpers</h2>
        <p class="lead">Global functions, handy inside views</p>
        <div class="table-wrap">
            <table>
                <tr><th>Code</th><th>Output</th></tr>
                <tr><td><code>bn_number(1250)</code> টাকা</td><td class="bn">{{ bn_number(1250) }} টাকা</td></tr>
                <tr><td><code>bn_words(500)</code></td><td class="bn">{{ bn_words(500) }}</td></tr>
                <tr><td><code>bn_date('2026-12-16')</code></td><td class="bn">{{ bn_date('2026-12-16') }}</td></tr>
                <tr><td><code>bn_date(now(), 'h:i A')</code></td><td class="bn">{{ bn_date(now(), 'h:i A') }}</td></tr>
            </table>
        </div>
    </section>
@endsection
