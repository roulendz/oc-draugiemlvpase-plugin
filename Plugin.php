<?php
namespace Logingrupa\DraugiemlvPase;

use System\Classes\PluginBase;

// use Illuminate\Foundation\AliasLoader;
// use Laravel\Socialite\Contracts\Factory;

/**
 * DraugiemlvPase Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * @var boolean Determine if this plugin should have elevated privileges.
     */

    /**
     * @var array Plugin dependencies
     */
    public $require = ['RainLab.User', 'October.Drivers', 'RomaldyMinaya.Socialite'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'Draugiem.lv Socialite Provider',
            'description' => 'No description provided yet...',
            'author' => 'LOGIN GRUPA',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        // $socialite = $this->app->make('Laravel\Socialite\Facades\Socialite');
        // $socialite->extend(
        //     'draugiem',
        //     function ($app) use ($socialite) {
        //         $config = \Config::get('Logingrupa.DraugiemlvPase::services.draugiem');
        //         return $socialite->buildProvider(DraugiemlvProvider::class, $config);
        //     }
        // );
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        // $this->app->make('Laravel\Socialite\Contracts\Factory', function ($app) {
        //     $socialiteManager = new SocialiteManager($app);

        //     $socialiteManager->extend('draugiem', function () use ($socialiteManager) {
        //         $config = \Config::get('Logingrupa.DraugiemlvPase::services.draugiem');

        //         return $socialiteManager->buildProvider(
        //             \Logingrupa\DraugiemlvPase\DraugiemlvProvider::class,
        //             $config
        //         );
        //     });
        //     return $socialiteManager;
        // });

        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'draugiem',
            function ($app) use ($socialite) {
                $config = \Config::get('services.draugiem');
                return $socialite->buildProvider(
                    \Logingrupa\DraugiemlvPase\DraugiemlvProvider::class,
                    $config
                );
            }
        );

        \Event::listen('Logingrupa\DraugiemlvPase\DraugiemExtendSocialite@handle', \SocialiteProviders\Manager\SocialiteWasCalled::class);
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Logingrupa\Draugiemlvpase\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'Logingrupa.DraugiemlvPase.some_permission' => [
                'tab' => 'DraugiemlvPase',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'DraugiemlvPase' => [
                'label' => 'DraugiemlvPase',
                'url' => Backend::url('Logingrupa'),
                'icon' => 'icon-leaf',
                'permissions' => ['Logingrupa.DraugiemlvPase.*'],
                'order' => 500,
            ],
        ];
    }

    public function registerMarkupTags()
    {
        return [
            'functions' => [
                'route' => [$this, 'signInRoute'],
            ]
        ];
    }

    /**
     * Return the sign in route for the specified provider
     */
    public function signInRoute($provider)
    {
        return route('socialiteSignIn', $provider);
    }
}
