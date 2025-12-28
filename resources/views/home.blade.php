<x-app-shell title="Sheel Express" active="home">
  <div class="grad-border rounded-[28px]">
    <section class="glass rounded-[28px] p-6 overflow-hidden relative">
      <div class="absolute inset-0 opacity-30 bg-gradient-to-l from-red-500/20 via-blue-500/10 to-emerald-500/10 animate-shimmer"></div>

      <div class="relative">
        <div class="badge mb-3">🚀 تجربة موبايل + OTP</div>

        <h1 class="text-3xl font-black leading-tight mb-2">
          شيل إكسبريس<br>
          <span class="text-white/80 text-xl font-bold">شحن باب لباب بشكل تطبيق</span>
        </h1>

        <p class="text-white/75 text-sm leading-6 mb-6">
          ادخل رقم جوالك، فعّل OTP، وبعدها أنشئ شحنتك خلال ثواني.
        </p>

        <div class="grid grid-cols-2 gap-2">
          <a href="{{ route('phone.start') }}" class="btn-primary text-center">ابدأ الآن</a>
          <a href="{{ route('shipments.create') }}" class="btn-ghost text-center">إنشاء شحنة</a>
        </div>

        <div class="mt-5 grid grid-cols-3 gap-2 text-xs text-white/70">
          <div class="glass rounded-2xl p-3 border border-white/10">
            <div class="font-black text-white">OTP</div>
            <div>تأكيد رقم العميل</div>
          </div>
          <div class="glass rounded-2xl p-3 border border-white/10">
            <div class="font-black text-white">Pickup</div>
            <div>تحديد الاستلام</div>
          </div>
          <div class="glass rounded-2xl p-3 border border-white/10">
            <div class="font-black text-white">Track</div>
            <div>متابعة الشحنة</div>
          </div>
        </div>
      </div>
    </section>
  </div>
</x-app-shell>

