<?php
namespace Logingrupa\draugiemlvpase;

use System\Classes\PluginBase;
use RomaldyMinaya\Socialite\Plugin as SocialitePluginModel;

// use Illuminate\Foundation\AliasLoader;
// use Laravel\Socialite\Contracts\Factory;

/**
 * draugiemlvpase Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * @var boolean Determine if this plugin should have elevated privileges.
     */

    /**
     * @var array Plugin dependencies
     */
    public $require = ['RainLab.User','October.Drivers', 'RomaldyMinaya.Socialite'];
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Draugiem.lv Socialite Provider',
            'description' => 'No description provided yet...',
            'author'      => 'LOGIN GRUPA',
            'icon'        => 'icon-leaf'
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
        //     'draugiemlv',
        //     function ($app) use ($socialite) {
        //         $config = $app['config']['services.draugiemlv'];
        //         return $socialite->buildProvider(Logingrupa\Draugiemlvpase\Helpers\SocialiteDraugiemlvProvider::class, $config);
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

        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'draugiem',
            function ($app) use ($socialite) {
                $config = \Config::get('logingrupa.draugiemlvpase::services.draugiem');
                return $socialite->buildProvider(Provider::class, $config);
            }
        );

        \Event::listen('logingrupa\draugiemlvpase\DraugiemExtendSocialite@handle', \SocialiteProviders\Manager\SocialiteWasCalled::class);
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
            'logingrupa.draugiemlvpase.some_permission' => [
                'tab' => 'draugiemlvpase',
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
            'draugiemlvpase' => [
                'label'       => 'draugiemlvpase',
                'url'         => Backend::url('logingrupa'),
                'icon'        => 'icon-leaf',
                'permissions' => ['logingrupa.draugiemlvpase.*'],
                'order'       => 500,
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
