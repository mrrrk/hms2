<?php

namespace HMS\Helpers;

use Symfony\Component\HttpFoundation\IpUtils;

/**
 * Place to keep general helper that will be available via the HmsHelper:: facade.
 */
class HmsHelper
{
    /**
     * Check if the current request is coming from inside the hackspace networks.
     *
     * @return bool
     */
    public function inTheSpace($request = null)
    {
        if (is_null($request)) {
            $request = request();
        }

        // Allowed IPs
        $allowed = [env('RESTRICED_IP_RANGE', '10.0.0.0/8')];

        if (IpUtils::checkIp($request->ip(), $allowed)) {
            return true;
        }

        return false;
    }
}
