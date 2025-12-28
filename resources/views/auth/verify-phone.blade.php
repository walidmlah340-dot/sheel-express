<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 text-center">
        تم إرسال رمز تحقق إلى رقم الجوال:
        <strong>{{ $phone }}</strong>
        <br>
        الرجاء إدخال الرمز المكوّن من 6 أرقام.
    </div>

    @if (session('status'))
        <div class="mb-4 text-sm text-green-600 text-center">
            {{ session('status') }}
        </div>
    @endif

    <form id="otpForm" method="POST" action="{{ route('phone.verify.submit') }}" novalidate>
        @csrf

        {{-- OTP --}}
        <div class="relative">
            <x-input-label for="code" value="رمز التحقق" />
            <x-text-input
                id="code"
                class="block mt-1 w-full text-center tracking-widest text-lg"
                type="text"
                name="code"
                maxlength="6"
                inputmode="numeric"
                autofocus
                placeholder="••••••"
                autocomplete="one-time-code"
            />

            {{-- ✅ رسالة احترافية تحت الحقل (بديل فقاعة المتصفح) --}}
            <div id="codeTip" class="hidden mt-3">
                <div class="flex items-start gap-3 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 shadow-sm">
                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-amber-100 text-amber-700 font-extrabold">
                        !
                    </div>
                    <div class="leading-5">
                        <div id="codeTipText" class="text-sm font-semibold text-amber-900">
                            يرجى ملء هذا الحقل.
                        </div>
                        <div class="text-xs text-amber-800/80 mt-0.5">
                            أدخل 6 أرقام ثم اضغط تأكيد.
                        </div>
                    </div>
                </div>
            </div>

            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        {{-- Countdown --}}
        <div class="mt-3 text-sm text-gray-500 dark:text-gray-400 text-center">
            يمكنك إعادة إرسال الرمز بعد
            <span id="countdown">60</span>
            ثانية
        </div>

        <div class="flex items-center justify-between mt-4">
            {{-- Resend --}}
            <button
                id="resendBtn"
                formaction="{{ route('phone.verify.resend') }}"
                formmethod="POST"
                class="text-sm underline text-gray-400 cursor-not-allowed"
                disabled
            >
                @csrf
                إعادة إرسال الرمز
            </button>

            <x-primary-button>
                تأكيد
            </x-primary-button>
        </div>
    </form>

    {{-- Timer + Validation --}}
    <script>
        // ===== Timer =====
        let timeLeft = 60;
        const countdownEl = document.getElementById('countdown');
        const resendBtn = document.getElementById('resendBtn');

        const timer = setInterval(() => {
            timeLeft--;
            countdownEl.textContent = timeLeft;

            if (timeLeft <= 0) {
                clearInterval(timer);
                resendBtn.disabled = false;
                resendBtn.classList.remove('cursor-not-allowed', 'text-gray-400');
                resendBtn.classList.add('text-blue-600');
                countdownEl.textContent = '0';
            }
        }, 1000);

        // ===== Custom Tip (Professional) =====
        const form = document.getElementById('otpForm');
        const codeEl = document.getElementById('code');
        const tip = document.getElementById('codeTip');
        const tipText = document.getElementById('codeTipText');

        function showTip(msg){
            tipText.textContent = msg;
            tip.classList.remove('hidden');
        }
        function hideTip(){
            tip.classList.add('hidden');
        }

        // يمنع أي حروف ويخليها أرقام فقط
        codeEl.addEventListener('input', () => {
            const cleaned = (codeEl.value || '').replace(/\D/g,'').slice(0,6);
            if (codeEl.value !== cleaned) codeEl.value = cleaned;

            // لو بدأ يكتب نخفي الرسالة
            if (cleaned.length > 0) hideTip();
        });

        // تحقق احترافي عند الضغط على تأكيد (بدون فقاعة المتصفح)
        form.addEventListener('submit', (e) => {
            const v = (codeEl.value || '').trim();

            if (!v) {
                e.preventDefault();
                showTip('يرجى ملء هذا الحقل.');
                codeEl.focus();
                return;
            }

            if (!/^\d{6}$/.test(v)) {
                e.preventDefault();
                showTip('رمز التحقق يجب أن يكون 6 أرقام.');
                codeEl.focus();
                return;
            }

            hideTip(); // تمام
        });
    </script>
</x-guest-layout>
