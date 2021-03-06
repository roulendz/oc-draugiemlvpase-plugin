<?php
namespace Logingrupa\DraugiemlvPase;

use SocialiteProviders\Manager\SocialiteWasCalled;

class DraugiemExtendSocialite
{
    /**
     * Register the provider.
     *
     * @param \SocialiteProviders\Manager\SocialiteWasCalled $socialiteWasCalled
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite(
            'draugiem',
            __NAMESPACE__ . '\DraugiemlvProvider'
        );
    }
}
