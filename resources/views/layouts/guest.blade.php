<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Tajawal Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            html, body{
                font-family:'Tajawal',system-ui,-apple-system,BlinkMacSystemFont,sans-serif !important;
            }

            /* ===== Soft Light App Background ===== */
            .app-bg{
                background:
                    radial-gradient(900px 500px at 15% 10%, rgba(99,102,241,.18), transparent 60%),
                    radial-gradient(800px 450px at 85% 20%, rgba(16,185,129,.14), transparent 60%),
                    radial-gradient(900px 500px at 50% 90%, rgba(59,130,246,.10), transparent 55%),
                    linear-gradient(180deg, #f6f7fb 0%, #eef2f7 55%, #eef2f7 100%);
            }

            /* ===== Glass Card ===== */
            .glass-card{
                background: rgba(255,255,255,.72);
                border: 1px solid rgba(148,163,184,.35);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                box-shadow:
                    0 14px 40px rgba(15,23,42,.10),
                    0 1px 0 rgba(255,255,255,.55) inset;
                border-radius: 18px;
            }

            /* ===== Tiny top bar actions ===== */
            .top-actions a, .top-actions button{
                border-radius: 12px;
                padding: 8px 12px;
                font-size: 13px;
                line-height: 1;
                box-shadow: 0 8px 18px rgba(15,23,42,.10);
                border: 1px solid rgba(148,163,184,.35);
                background: rgba(255,255,255,.65);
                backdrop-filter: blur(10px);
                transition: transform .15s ease, box-shadow .15s ease, background .15s ease;
            }
            .top-actions a:hover, .top-actions button:hover{
                transform: translateY(-1px);
                box-shadow: 0 12px 24px rgba(15,23,42,.14);
                background: rgba(255,255,255,.82);
            }
            .btn-danger{
                background: rgba(239,68,68,.12) !important;
                border-color: rgba(239,68,68,.25) !important;
                color: #b91c1c !important;
                font-weight: 700;
            }
            .btn-primary{
                background: rgba(79,70,229,.12) !important;
                border-color: rgba(79,70,229,.22) !important;
                color: #3730a3 !important;
                font-weight: 700;
            }

            /* ===== Toasts ===== */
            #toast-container{
                position: fixed;
                top: 18px;
                left: 50%;
                transform: translateX(-50%);
                z-index: 9999;
                display: flex;
                flex-direction: column;
                gap: 10px;
                pointer-events: none;
            }
            .toast{
                min-width: 280px;
                max-width: 92vw;
                padding: 12px 16px;
                border-radius: 14px;
                color: #fff;
                font-size: 14px;
                box-shadow: 0 14px 30px rgba(0,0,0,.18);
                animation: toastIn .25s ease;
                pointer-events: auto;
            }
            .toast-success{ background:#16a34a; }
            .toast-error{ background:#dc2626; }
            .toast-info{ background:#2563eb; }

            @keyframes toastIn{
                from{ opacity:0; transform: translateY(-10px); }
                to{ opacity:1; transform: translateY(0); }
            }
        </style>
    </head>

    <body class="text-slate-900 antialiased">
        <div id="toast-container"></div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-8 sm:pt-0 app-bg">
            <div class="mb-4">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-slate-700" />
                </a>
            </div>

            <div class="w-full sm:max-w-md">
                @auth
                    <!-- ✅ فوق البطاقة -->
                    <div class="top-actions flex items-center justify-end gap-2 mb-3 px-1">
                        <a href="{{ route('dashboard') }}" class="btn-primary">
                            لوحة التحكم
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn-danger">
                                تسجيل خروج
                            </button>
                        </form>
                    </div>
                @endauth

                <!-- ✅ Glass Card -->
                <div class="glass-card px-6 py-5">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <script>
            function showToast(message, type = 'info', duration = 3000) {
                const container = document.getElementById('toast-container');
                if (!container) return;

                const toast = document.createElement('div');
                toast.className = `toast toast-${type}`;
                toast.textContent = message;
                container.appendChild(toast);

                setTimeout(() => {
                    toast.style.opacity = '0';
                    toast.style.transition = 'opacity .2s ease';
                    setTimeout(() => toast.remove(), 220);
                }, duration);
            }

            @if (session('status'))
                showToast(@json(session('status')), 'success');
            @endif

            @if (session('error'))
                showToast(@json(session('error')), 'error');
            @endif

            @if ($errors->any())
                showToast(@json($errors->first()), 'error');
            @endif
        </script>
    </body>
</html>
