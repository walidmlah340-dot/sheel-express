<x-app-shell title="رمز التفعيل" active="home" :hideNav="true">
  <div class="grad-border rounded-[28px]">
    <div class="glass rounded-[28px] p-6">
      <div class="badge mb-3">✅ أدخل الرمز</div>
      <h2 class="text-2xl font-black mb-2">رمز التفعيل</h2>

      @if(session('otp_hint'))
        <div class="mb-4 p-3 rounded-2xl bg-emerald-500/10 border border-emerald-500/25">
          <div class="text-sm">
            رمز التجربة:
            <span class="font-black text-emerald-200">{{ session('otp_hint') }}</span>
          </div>
        </div>
      @endif

      <form method="POST" action="{{ route('phone.verify') }}" class="space-y-4">
        @csrf
        <input type="hidden" name="code" value="">

        <div data-otp-wrap class="flex gap-2 justify-center" dir="ltr">
          @for($i=1; $i<=4; $i++)
            <input
              data-otp="{{ $i }}"
              class="w-14 h-14 text-center text-2xl font-black rounded-2xl bg-black/30 border border-white/10 focus:border-red-500/60 focus:ring-2 focus:ring-red-500/20 outline-none transition"
              inputmode="numeric"
              maxlength="1"
            />
          @endfor
        </div>

        <button class="btn-primary w-full">تأكيد</button>
        <a href="{{ route('phone.start') }}" class="btn-ghost w-full block text-center">رجوع وتغيير الرقم</a>
      </form>

      <script>
        setTimeout(()=> {
          const el = document.querySelector('[data-otp="1"]');
          if(el) el.focus();
        }, 150);
      </script>
    </div>
  </div>
</x-app-shell>
