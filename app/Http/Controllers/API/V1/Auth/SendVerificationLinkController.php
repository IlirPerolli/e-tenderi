<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\API\APIController;

class SendVerificationLinkController extends APIController
{
    public function __invoke()
    {
        if (user()->hasVerifiedEmail()) {
            return $this->respondWithError(403, __('app.verify.completed.error'));
        }

        user()->sendEmailVerificationNotification();

        return $this->respondWithSuccess();
    }
}
