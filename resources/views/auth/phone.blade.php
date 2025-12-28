<x-app-shell title="تأكيد الجوال" active="home" :hideNav="true">
  <div class="grad-border rounded-[28px]">
    <div class="glass rounded-[28px] p-6">
      <div class="badge mb-3">🔐 التحقق من الهوية</div>
      <h2 class="text-2xl font-black mb-2">اكتب رقم جوالك</h2>
      <p class="text-sm text-white/75 mb-5">سنرسل رمز OTP للتأكيد. (حاليًا كود تجريبي)</p>

      <form method="POST" action="{{ route('phone.send') }}" class="space-y-3">
        @csrf
        <input name="phone" class="inp" placeholder="مثال: 055xxxxxxx" inputmode="numeric">
        <button class="btn-primary w-full">إرسال الرمز</button>
      </form>

      <div class="mt-4 text-xs text-white/60">
        اكتب أي رقم للتجربة، وبعدها ادخل رمز 1234 (لو OTP_BYPASS=true).
      </div>
    </div>
  </div>
</x-app-shell>
