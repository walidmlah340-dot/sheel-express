<x-app-shell title="حسابي" active="me">
  <div class="grad-border rounded-[28px]">
    <div class="glass rounded-[28px] p-6">
      <div class="badge mb-3">👤 حسابي</div>
      <h2 class="text-2xl font-black mb-4">بيانات المستخدم</h2>

      <div class="space-y-2 text-sm text-white/85">
        <div class="glass rounded-2xl p-4 border border-white/10">
          <div class="text-white/70 mb-1">الاسم</div>
          <div class="font-bold">{{ auth()->user()->name }}</div>
        </div>

        <div class="glass rounded-2xl p-4 border border-white/10">
          <div class="text-white/70 mb-1">الجوال</div>
          <div class="font-bold">{{ auth()->user()->phone ?? '-' }}</div>
        </div>

        <div class="glass rounded-2xl p-4 border border-white/10">
          <div class="text-white/70 mb-1">حالة التفعيل</div>
          <div class="font-bold">
            {{ auth()->user()->phone_verified_at ? '✅ مفعّل' : '⚠️ غير مفعّل' }}
          </div>
        </div>
      </div>

      <form method="POST" action="{{ route('logout') }}" class="mt-5">
        @csrf
        <button class="btn-ghost w-full">تسجيل خروج</button>
      </form>
    </div>
  </div>
</x-app-shell>
