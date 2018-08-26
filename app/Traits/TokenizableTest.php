<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait Tokenizabletest
 *
 * @method   array getAuthToken()
 */

trait TokenizableTest
{
    /**
     * Do the request for authorzation token
     *
     * @return array
     */
    function getAuthToken(): array
    {
        $auth = $this->json('POST', '/auth/login', [
            'email'    => 'admin@salomon.com',
            'password' => 's@l0m0n',
        ])->seeStatusCode(200)->response->getContent();

        return json_decode($auth, true);
    }
}
