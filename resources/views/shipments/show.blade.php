<x-app-shell title="تم إنشاء الشحنة" active="ship">
  <div class="grad-border rounded-[28px]">
    <div class="glass rounded-[28px] p-6">
      <div class="badge mb-3">✅ نجاح</div>
      <h2 class="text-2xl font-black mb-4">تم إنشاء الشحنة</h2>

      <div class="space-y-2 text-sm text-white/85">
        <div class="glass rounded-2xl p-4 border border-white/10">
          <div class="flex items-center justify-between">
            <span class="text-white/70">رقم الشحنة</span>
            <span class="font-black text-white">#{{ $shipment->id }}</span>
          </div>
        </div>

        <div class="glass rounded-2xl p-4 border border-white/10">
          <div class="text-white/70 mb-1">الاستلام</div>
          <div class="font-bold">{{ $shipment->pickup_address }}</div>
        </div>

        <div class="glass rounded-2xl p-4 border border-white/10">
          <div class="text-white/70 mb-1">التسليم</div>
          <div class="font-bold">{{ $shipment->dropoff_address }}</div>
        </div>

        <div class="glass rounded-2xl p-4 border border-white/10">
          <div class="flex items-center justify-between">
            <span class="text-white/70">الحالة</span>
            <span class="badge">🟢 {{ $shipment->status }}</span>
          </div>
        </div>
      </div>

      <div class="mt-5 grid grid-cols-2 gap-2">
        <a href="{{ route('shipments.create') }}" class="btn-primary text-center">شحنة جديدة</a>
        <a href="{{ route('home') }}" class="btn-ghost text-center">الرئيسية</a>
      </div>
    </div>
  </div>
</x-app-shell>
