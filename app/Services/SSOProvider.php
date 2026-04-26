<?php

namespace App\Services;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\User;

class SSOProvider extends AbstractProvider
{
    protected $scopes = [];

    protected function getAuthUrl($state)
    {
        // log config 
        logger()->info('config', [
            'config' => config('services.sso'),
        ]);

        return $this->buildAuthUrlFromBase(
            config('services.sso.base_uri') . '/oauth/authorize',
            $state
        );
    }

    protected function getTokenUrl()
    {
        return config('services.sso.base_uri') . '/oauth/token';
    }

    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get(
            config('services.sso.base_uri') . '/api/user',
            [
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
