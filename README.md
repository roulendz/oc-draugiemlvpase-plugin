# oc-draugiemlvpase-plugin
OctoberCMS extending romaldyminaya/socialite custom social provider for draugiem.lv using Draugiem.lv Pase

To get working this plugin you need - to install https://octobercms.com/plugin/romaldyminaya-socialite

Do not forget to modify


config/services.php
```
'draugiem' => [
          'callback_url' => env('DRAUGIEMPASE_CALLBACK_URL', '/rs/socialite/draugiem/auth/callback'),
          'client_id' => env('DRAUGIEMPASE_CLIENT_ID', ''),
          'client_secret' => env('DRAUGIEMPASE_CLIENT_SECRET', ''),
          'is_activated' => env('DRAUGIEMPASE_IS_ACTIVATED', '1'),
          'scopes' => env('DRAUGIEMPASE_SCOPES', []),
          'redirect' => env('DRAUGIEMPASE_REDIRECT', '/rs/socialite/draugiem/auth/callback'),
      ]

```
or update yout .env file

```
DRAUGIEMPASE_CALLBACK_URL=
DRAUGIEMPASE_CLIENT_ID=
DRAUGIEMPASE_CLIENT_SECRET=
DRAUGIEMPASE_IS_ACTIVATED=1
DRAUGIEMPASE_SCOPES=[]
DRAUGIEMPASE_REDIRECT=

```

TODO:

in RomaldyMinaya\Socialite\Plugin.php add draugiem to $providers array
Need to make it dynamic.

```
    public static $providers = ['google', 'facebook', 'github', 'draugiem'];
```
