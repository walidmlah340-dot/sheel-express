@props([
  'title' => 'Sheel Express',
  'active' => 'home',
  'hideNav' => false,
])

<!doctype html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <meta name="theme-color" content="#070A12">
  <title>{{ $title }}</title>

  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-white selection:bg-red-500/30">
  <div class="pointer-events-none fixed inset-0 overflow-hidden">
    <div class="absolute -top-24 -right-24 w-[320px] h-[320px] rounded-full bg-red-500/25 blur-3xl animate-floaty"></div>
    <div class="absolute top-40 -left-24 w-[280px] h-[280px] rounded-full bg-blue-500/20 blur-3xl animate-floaty" style="animation-delay: .6s;"></div>
    <div class="absolute -bottom-24 left-1/2 -translate-x-1/2 w-[420px] h-[420px] rounded-full bg-emerald-500/15 blur-3xl animate-floaty" style="animation-delay: 1.2s;"></div>
  </div>

  <div class="min-h-screen pb-24">
    <header class="sticky top-0 z-50 px-4 pt-4">
      <div class="grad-border rounded-[28px]">
        <div class="glass rounded-[28px] px-4 py-3 flex items-center justify-between">
          <a href="{{ route('home') }}" class="flex items-center gap-2">
            <div class="w-10 h-10 rounded-2xl bg-red-500/20 border border-white/10 grid place-items-center shadow-glow">
              <span class="font-black text-red-300">S</span>
            </div>
            <div class="leading-tight">
              <div class="font-black text-base">Sheel Express</div>
              <div class="text-xs text-white/70">Door to Door • Mobile UI</div>
            </div>
          </a>

          <div class="flex items-center gap-2">
            @auth
              <span class="badge">{{ auth()->user()->phone ?? 'User' }}</span>
            @endauth

            <a href="{{ route('shipments.create') }}" class="btn-primary !py-2 !px-3 text-sm">
              اشحن الآن
            </a>
          </div>
        </div>
      </div>
    </header>

    <main class="px-4 mt-4 page-enter">
      @if ($errors->any())
        <div class="grad-border rounded-[28px] mb-4">
          <div class="glass rounded-[28px] p-4 border border-red-500/20">
            <div class="font-black text-red-200 mb-2">تحقق من البيانات</div>
            <ul class="text-sm text-white/85 list-disc pr-5 space-y-1">
              @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif

      {{ $slot }}
    </main>
  </div>

  @if(!$hideNav)
    <nav class="navbar fixed bottom-0 left-0 right-0 z-50 pb-[env(safe-area-inset-bottom)]">
      <div class="max-w-2xl mx-auto px-4 py-3">
        <div class="grid grid-cols-3 gap-2">
          <a href="{{ route('home') }}"
             class="rounded-2xl px-3 py-2 text-center border border-white/10 transition
             {{ $active==='home' ? 'bg-white/10' : 'bg-white/5 hover:bg-white/10' }}">
            <div class="font-black text-sm">الرئيسية</div>
            <div class="text-[11px] text-white/70">Home</div>
          </a>

          <a href="{{ route('shipments.create') }}"
             class="rounded-2xl px-3 py-2 text-center border border-red-500/30 bg-red-500/15 hover:bg-red-500/20 transition shadow-glow">
            <div class="font-black text-sm text-red-100">شحنة جديدة</div>
            <div class="text-[11px] text-red-100/70">Ship</div>
          </a>

          <a href="{{ route('profile') }}"
             class="rounded-2xl px-3 py-2 text-center border border-white/10 transition
             {{ $active==='me' ? 'bg-white/10' : 'bg-white/5 hover:bg-white/10' }}">
            <div class="font-black text-sm">حسابي</div>
            <div class="text-[11px] text-white/70">Me</div>
          </a>
        </div>
      </div>
    </nav>
  @endif
</body>
</html>

