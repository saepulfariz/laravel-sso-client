<?php

namespace App\Services;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\User;

class SSOLdapProvider extends AbstractProvider
{
    protected $scopes = [];

    protected function getAuthUrl($state)
    {
        // log config 
        logger()->info('config', [
            'config' => config('services.sso_ldap'),
        ]);

        return $this->buildAuthUrlFromBase(
            config('services.sso_ldap.base_uri') . '/oauth/authorize',
            $state
        );
    }

    protected function getTokenUrl()
    {
        return config('services.sso_ldap.base_uri') . '/oauth/token';
    }

    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get(
            config('services.sso_ldap.base_uri') . '/api/user',
            [
                'verify' => false, // ⚠️ disable SSL check
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]
        );

        return json_decode($response->getBody(), true);
    }

    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id' => $user['id'],
            'nickname' => null,
            'name' => $user['name'],
            'email' => $user['email'],
            'avatar' => null,
        ]);
    }
}
