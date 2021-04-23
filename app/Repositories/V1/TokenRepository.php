<?php

namespace App\Repositories\V1;

use Laravel\Sanctum\PersonalAccessToken;

/**
 * Layer to handle datastore operations. Can be a local operation or external datastore
 */
class TokenRepository
{
    /**
     * Variable to hold injected dependency
     *
     * @var PersonalAccessToken
     */
    protected $personalAccessToken;

    /**
     * Initializing the instances and variables
     *
     * @param PersonalAccessToken $personalAccessToken
     */
    public function __construct(PersonalAccessToken $personalAccessToken)
    {
        $this->personalAccessToken = $personalAccessToken;
    }

    public function getTokenById($id){
        return PersonalAccessToken::where("id", $id)->first();
    }

    public function revokeToken($id){
        return $this->getTokenById($id)->delete();
    }

}
