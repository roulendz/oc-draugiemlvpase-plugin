<?php
/**
 * Social providers Scopes (Permissions)
 * draugiemlv      https://www.draugiem.lv/applications/dev/docs/passport_en/
 */
return [
    'draugiem' => [
          'callback_url' => env('DRAUGIEMPASE_CALLBACK_URL', '/rs/socialite/draugiem/auth/callback'),
          'client_id' => env('DRAUGIEMPASE_CLIENT_ID', ''),
          'client_secret' => env('DRAUGIEMPASE_CLIENT_SECRET', ''),
          'is_activated' => env('DRAUGIEMPASE_IS_ACTIVATED', '1'),
          'scopes' => env('DRAUGIEMPASE_SCOPES', []),
          'redirect' => env('DRAUGIEMPASE_REDIRECT', '/rs/socialite/draugiem/auth/callback'),
      ]
];
