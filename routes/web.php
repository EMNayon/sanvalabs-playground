<?php

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Sanvalabs\BanglaConverter\Facades\BanglaNumber;
use Sanvalabs\BdPhone\Facades\BdPhone;
use Sanvalabs\BdPhone\Rules\ValidBdPhone;

Route::view('/', 'home');

Route::get('/bangla', function (Request $request) {
    $number = trim((string) $request->query('number', '1250000'));
    $english = BanglaNumber::toEnglish($number);

    try {
        $words = BanglaNumber::toWords($english);
    } catch (InvalidArgumentException) {
        $words = null;
    }

    try {
        $date = Carbon::parse($request->query('date', now()->format('Y-m-d\TH:i')));
    } catch (Exception) {
        $date = now();
    }

    return view('bangla', [
        'number' => $number,
        'digits' => BanglaNumber::convert($english),
        'english' => $english,
        'words' => $words,
        'date' => $date,
        'format' => (string) $request->query('format', 'l, j F Y, h:i A'),
        'formats' => ['j F Y', 'l, j F Y', 'D, j M Y', 'd/m/Y', 'h:i A', 'j F Y, h:i A'],
    ]);
});

Route::get('/phone', function () {
    return view('phone', [
        'operators' => array_unique(config('bd-phone.operators')),
    ]);
});

Route::post('/phone', function (Request $request) {
    $lang = $request->input('lang') === 'bn' ? 'bn' : 'en';
    app()->setLocale($lang);

    // Only accept operator names that exist in the config.
    $allowed = array_values(array_intersect(
        (array) $request->input('operators', []),
        config('bd-phone.operators'),
    ));

    $request->validate(
        ['phone' => ['required', new ValidBdPhone($allowed)]],
        [],
        ['phone' => $lang === 'bn' ? 'মোবাইল নম্বর' : 'mobile number'],
    );

    return back()->withInput()->with('result', [
        'input' => $request->phone,
        'normalized' => BdPhone::normalize($request->phone),
        'operator' => BdPhone::operator($request->phone),
        'international' => BdPhone::international($request->phone),
    ]);
});
