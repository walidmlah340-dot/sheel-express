<x-app-shell title="شحنة جديدة" active="ship">
  <div class="grad-border rounded-[28px]">
    <div class="glass rounded-[28px] p-6">
      <div class="flex items-center justify-between mb-4">
        <div>
          <div class="badge">🚚 إنشاء شحنة</div>
          <h2 class="text-2xl font-black mt-2">امشي خطوة بخطوة</h2>
          <p class="text-sm text-white/75">3 مراحل سريعة — زي تطبيق موبايل.</p>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-red-500/15 border border-red-500/25 grid place-items-center shadow-glow">
          <span class="text-red-200 font-black">+</span>
        </div>
      </div>

      <div class="flex items-center gap-2 mb-5">
        <div id="s1" class="flex-1 h-2 rounded-full bg-red-500/60"></div>
        <div id="s2" class="flex-1 h-2 rounded-full bg-white/10"></div>
        <div id="s3" class="flex-1 h-2 rounded-full bg-white/10"></div>
      </div>

      <form method="POST" action="{{ route('shipments.store') }}" class="space-y-4">
        @csrf

        <div data-step="1" class="space-y-3">
          <div class="font-black text-white/90">1) عناوين</div>
          <input name="pickup_address" class="inp" placeholder="عنوان الاستلام (Pickup)" required>
          <input name="dropoff_address" class="inp" placeholder="عنوان التسليم (Dropoff)" required>
          <button type="button" class="btn-primary w-full" onclick="nextStep()">التالي</button>
        </div>

        <div data-step="2" class="space-y-3 hidden">
          <div class="font-black text-white/90">2) تفاصيل الشحنة</div>
          <input name="package_desc" class="inp" placeholder="وصف الشحنة (اختياري)">
          <div class="grid grid-cols-2 gap-2">
            <input name="weight" class="inp" placeholder="الوزن" inputmode="decimal">
            <input name="cod_amount" class="inp" placeholder="مبلغ عند الاستلام" inputmode="decimal">
          </div>
          <div class="grid grid-cols-2 gap-2">
            <button type="button" class="btn-ghost w-full" onclick="prevStep()">رجوع</button>
            <button type="button" class="btn-primary w-full" onclick="nextStep()">التالي</button>
          </div>
        </div>

        <div data-step="3" class="space-y-3 hidden">
          <div class="font-black text-white/90">3) تأكيد</div>
          <div class="glass rounded-2xl p-4 border border-white/10 text-sm text-white/80">
            <div class="mb-2 font-black text-white">راجع بياناتك ثم أكد</div>
            <div>✅ بعد التأكيد هتظهر صفحة تفاصيل الشحنة.</div>
          </div>
          <div class="grid grid-cols-2 gap-2">
            <button type="button" class="btn-ghost w-full" onclick="prevStep()">رجوع</button>
            <button class="btn-primary w-full">تأكيد الشحنة</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script>
    let step = 1;
    function paint(){
      document.querySelectorAll('[data-step]').forEach(el=>{
        el.classList.toggle('hidden', parseInt(el.dataset.step,10) !== step);
      });
      document.getElementById('s1').className = "flex-1 h-2 rounded-full " + (step>=1 ? "bg-red-500/60" : "bg-white/10");
      document.getElementById('s2').className = "flex-1 h-2 rounded-full " + (step>=2 ? "bg-red-500/60" : "bg-white/10");
      document.getElementById('s3').className = "flex-1 h-2 rounded-full " + (step>=3 ? "bg-red-500/60" : "bg-white/10");
    }
    function nextStep(){ if(step<3){ step++; paint(); window.scrollTo({top:0, behavior:"smooth"}); } }
    function prevStep(){ if(step>1){ step--; paint(); window.scrollTo({top:0, behavior:"smooth"}); } }
  </script>
</x-app-shell>
