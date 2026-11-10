<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sanvalabs Packages') · Sanvalabs</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f6f7f9;
            --surface: #ffffff;
            --surface-2: #f1f3f6;
            --text: #111827;
            --muted: #6b7280;
            --border: #e4e7ec;
            --accent: #0f766e;
            --accent-hover: #115e59;
            --accent-soft: #e6f4f2;
            --on-accent: #ffffff;
            --success: #15803d;
            --success-soft: #e8f6ec;
            --error: #b42318;
            --error-soft: #fdecea;
            --shadow: 0 1px 2px rgba(16, 24, 40, .04), 0 4px 16px rgba(16, 24, 40, .06);
            --radius: 14px;
            --font: 'Inter', 'Hind Siliguri', system-ui, sans-serif;
            --font-bn: 'Hind Siliguri', 'Inter', system-ui, sans-serif;
            --mono: 'JetBrains Mono', ui-monospace, monospace;
        }
        @media (prefers-color-scheme: dark) {
            :root {
                --bg: #0b1120;
                --surface: #111a2e;
                --surface-2: #17223a;
                --text: #e5e9f0;
                --muted: #8b97ab;
                --border: #233150;
                --accent: #2dd4bf;
                --accent-hover: #5eead4;
                --accent-soft: #0f3a3a;
                --on-accent: #062925;
                --success: #4ade80;
                --success-soft: #0f2e1d;
                --error: #f87171;
                --error-soft: #3a1414;
                --shadow: 0 1px 2px rgba(0, 0, 0, .3), 0 4px 16px rgba(0, 0, 0, .25);
            }
        }

        * { box-sizing: border-box; }
        body { margin: 0; background: var(--bg); color: var(--text); font-family: var(--font); line-height: 1.55; -webkit-font-smoothing: antialiased; }
        a { color: var(--accent); text-decoration: none; }
        a:hover { color: var(--accent-hover); }
        code, .mono { font-family: var(--mono); font-size: .9em; }
        .bn { font-family: var(--font-bn); }

        .container { max-width: 960px; margin: 0 auto; padding: 0 16px; }

        /* Header */
        .site-header { background: var(--surface); border-bottom: 1px solid var(--border); position: sticky; top: 0; z-index: 10; }
        .site-header .container { display: flex; align-items: center; gap: 24px; height: 60px; }
        .brand { display: flex; align-items: center; gap: 10px; font-weight: 700; color: var(--text); white-space: nowrap; }
        .brand-mark { width: 30px; height: 30px; border-radius: 8px; background: var(--accent); color: var(--on-accent); display: grid; place-items: center; font-family: var(--font-bn); font-size: 1rem; }
        .nav { display: flex; gap: 4px; overflow-x: auto; scrollbar-width: none; }
        @media (max-width: 480px) {
            .site-header .container { gap: 12px; }
            .brand-name { display: none; }
        }
        .nav a { padding: 6px 12px; border-radius: 8px; color: var(--muted); font-weight: 500; font-size: .95rem; white-space: nowrap; }
        .nav a:hover { color: var(--text); background: var(--surface-2); }
        .nav a.active { color: var(--accent); background: var(--accent-soft); }

        /* Page */
        main { padding: 40px 0 56px; }
        .page-head { margin-bottom: 28px; }
        .page-head h1 { margin: 0 0 6px; font-size: 1.9rem; letter-spacing: -.02em; }
        .page-head p { margin: 0; color: var(--muted); }
        .pill { display: inline-flex; align-items: center; gap: 6px; font-family: var(--mono); font-size: .8rem; background: var(--surface-2); border: 1px solid var(--border); color: var(--muted); padding: 3px 10px; border-radius: 999px; margin-bottom: 12px; align-self: flex-start; }

        .card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); box-shadow: var(--shadow); padding: 24px; }
        .card + .card { margin-top: 20px; }
        .card h2 { margin: 0 0 4px; font-size: 1.15rem; }
        .card .lead { margin: 0 0 18px; color: var(--muted); font-size: .95rem; }
        .grid-2 { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; }
        .grid-2 > .card { margin-top: 0; display: flex; flex-direction: column; }
        .grid-2 > .card > .push-bottom { margin-top: auto; }
        @media (max-width: 720px) { .grid-2 { grid-template-columns: 1fr; } }

        /* Forms */
        .field { margin-bottom: 18px; }
        .field > label, .legend { display: block; font-weight: 600; font-size: .92rem; margin-bottom: 6px; }
        .hint { color: var(--muted); font-weight: 400; font-size: .85rem; }
        .input {
            width: 100%; padding: 11px 14px; font: inherit; font-size: 1.05rem; color: var(--text);
            background: var(--surface-2); border: 1px solid var(--border); border-radius: 10px; transition: border-color .15s, box-shadow .15s;
        }
        .input:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 3px var(--accent-soft); }
        .input.invalid { border-color: var(--error); }
        .input-row { display: flex; gap: 10px; }
        .input-row .input { flex: 1; min-width: 0; }
        .error-text { color: var(--error); margin: 6px 0 0; font-size: .92rem; }

        .btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 11px 20px; font: inherit; font-weight: 600;
            border: 0; border-radius: 10px; background: var(--accent); color: var(--on-accent); cursor: pointer; white-space: nowrap;
        }
        .btn:hover { background: var(--accent-hover); color: var(--on-accent); }
        .btn-block { width: 100%; }
        .btn-ghost { background: transparent; color: var(--accent); border: 1px solid var(--border); }
        .btn-ghost:hover { background: var(--accent-soft); color: var(--accent); }

        .chips { display: flex; flex-wrap: wrap; gap: 6px; margin-top: 10px; }
        .chip {
            font: inherit; font-family: var(--mono); font-size: .8rem; color: var(--muted); background: transparent;
            border: 1px solid var(--border); border-radius: 999px; padding: 3px 10px; cursor: pointer;
        }
        .chip:hover { color: var(--accent); border-color: var(--accent); }

        .options { display: flex; flex-wrap: wrap; gap: 8px; }
        .option { position: relative; }
        .option input { position: absolute; opacity: 0; pointer-events: none; }
        .option span {
            display: inline-block; padding: 6px 14px; border: 1px solid var(--border); border-radius: 999px;
            font-size: .92rem; cursor: pointer; user-select: none; transition: all .15s;
        }
        .option input:checked + span { background: var(--accent-soft); border-color: var(--accent); color: var(--accent); font-weight: 600; }
        .option input:focus-visible + span { box-shadow: 0 0 0 3px var(--accent-soft); }

        /* Data display */
        .kv { display: grid; grid-template-columns: max-content 1fr; gap: 10px 20px; margin: 0; }
        .kv dt { color: var(--muted); font-size: .92rem; }
        .kv dd { margin: 0; word-break: break-word; }
        .big { font-family: var(--font-bn); font-size: 1.6rem; font-weight: 600; line-height: 1.3; }

        table { width: 100%; border-collapse: collapse; font-size: .95rem; }
        th, td { text-align: left; padding: 10px 12px; border-bottom: 1px solid var(--border); vertical-align: top; }
        th { color: var(--muted); font-weight: 500; font-size: .85rem; }
        tr:last-child td { border-bottom: 0; }
        .table-wrap { overflow-x: auto; }

        .badge { display: inline-block; padding: 2px 10px; border-radius: 999px; font-size: .85rem; font-weight: 600; background: var(--accent-soft); color: var(--accent); }

        .alert { display: flex; align-items: center; gap: 10px; padding: 14px 18px; border-radius: 12px; font-weight: 600; margin-bottom: 20px; }
        .alert-success { background: var(--success-soft); color: var(--success); }
        .alert-error { background: var(--error-soft); color: var(--error); }

        .terminal { background: #0b1120; color: #e5e9f0; font-family: var(--mono); font-size: .85rem; padding: 10px 14px; border-radius: 10px; overflow-wrap: anywhere; }
        .terminal::before { content: '$ '; color: #5eead4; }

        /* Footer */
        .site-footer { border-top: 1px solid var(--border); padding: 24px 0; color: var(--muted); font-size: .9rem; }
        .site-footer .container { display: flex; flex-wrap: wrap; justify-content: space-between; gap: 12px; }
        .site-footer nav { display: flex; gap: 16px; flex-wrap: wrap; }
        .site-footer a { color: var(--muted); }
        .site-footer a:hover { color: var(--accent); }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="container">
            <a href="/" class="brand"><span class="brand-mark">স</span> <span class="brand-name">Sanvalabs</span></a>
            <nav class="nav">
                <a href="/" @class(['active' => request()->is('/')])>Home</a>
                <a href="/bangla" @class(['active' => request()->is('bangla')])>Bangla Converter</a>
                <a href="/phone" @class(['active' => request()->is('phone')])>Phone Validator</a>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="site-footer">
        <div class="container">
            <span>Demo of Sanvalabs Laravel packages</span>
            <nav>
                <a href="https://github.com/EMNayon/bangla-converter">bangla-converter</a>
                <a href="https://github.com/EMNayon/bd-phone-validator">bd-phone-validator</a>
                <a href="https://packagist.org/packages/sanvalabs/">Packagist</a>
            </nav>
        </div>
    </footer>

    <script>
        // Sample chips fill the input named in data-target.
        document.querySelectorAll('[data-fill]').forEach((chip) => {
            chip.addEventListener('click', () => {
                const input = document.getElementById(chip.dataset.target);
                input.value = chip.dataset.fill;
                input.focus();
            });
        });
    </script>
</body>
</html>
