<?php

return [
    'expire_minutes' => (int) env('OTP_EXPIRE_MINUTES', 5),

    // للتجربة فقط (اعرض/اقبل كود ثابت)
    'bypass' => filter_var(env('OTP_BYPASS', false), FILTER_VALIDATE_BOOL),
    'bypass_code' => (string) env('OTP_BYPASS_CODE', '1234'),
];

