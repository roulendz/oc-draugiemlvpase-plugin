# oc-draugiemlvpase-plugin
OctoberCMS extending romaldyminaya/socialite custom social provider for draugiem.lv using Draugiem.lv Pase

To get working this plugin you need - to install https://octobercms.com/plugin/romaldyminaya-socialite

##Do not forget to modify


#config/services.php
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
#or update yout .env file

```
DRAUGIEMPASE_CALLBACK_URL=
DRAUGIEMPASE_CLIENT_ID=
DRAUGIEMPASE_CLIENT_SECRET=
DRAUGIEMPASE_IS_ACTIVATED=1
DRAUGIEMPASE_SCOPES=[]
DRAUGIEMPASE_REDIRECT=

```
#Need to modify RomaldyMinaya\Socialite\Http\Controllers\AuthController.php line ~50+

```
    /**
     * Callback url where the user is redirected from the social provider
     */
    public function callback()
    {
        if ($this->provider == 'draugiem') {
            if(!$this->request->has('dr_auth_code')) return $this->redirectToLoginPage();
        } else {
            if(!$this->request->has('code')) return $this->redirectToLoginPage();
        }
        //$user   = $this->users->findByEmailAndUpdateOrFindByUsernameOrCreate($this->getProviderUser(), $this->provider);
        $user   = $this->users->findByUsernameOrCreate($this->getProviderUser(), $this->provider);

        $this->auth->login($user, true);

        return redirect($this->getSuccessUrl());
    }
```
#Thisis how my UserRepository.php looks like
```
public function findByEmailAndUpdateOrFindByUsernameOrCreate($userData, $provider)
    {
        if ($provider == 'draugiem') {
            return $this->findByUsernameOrCreate($userData, $provider);
        } else {
            $user = User::whereEmail($userData->email)->first();
        }
        if ($user) {
            $user->rs_provider      = $provider;
            $user->rs_provider_id   = $userData->id;
            $user->name             = $userData->name;
            $user->email            = $userData->email;
            $user->avatar_url       = $userData->avatar_original ?: null;
            $user->is_activated     = true;
            $user->activated_at     = Carbon::now();

            //Do not need to regenerate password because user registred regular way
            // $user->password         = Hash::make(str_random(10));

            $user->update();
        } else {
            $this->findByUsernameOrCreate($userData, $provider);
        }
        return $user;
    }
```

#Add button to login page#
```
<a href="/rs/socialite/draugiem/auth/login" class="btn btn-lg btn-social btn-draugiem">
    <i class="fa fa-draugiem"></i> &nbsp; draugiem
</a>
```

TODO:

in RomaldyMinaya\Socialite\Plugin.php add draugiem to $providers array
Need to make it dynamic.

```
    public static $providers = ['google', 'facebook', 'github', 'draugiem'];
```


