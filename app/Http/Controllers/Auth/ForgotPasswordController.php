<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    use SendsPasswordResetEmails {
        sendResetLinkResponse as protected success;
        sendResetLinkFailedResponse as protected error;
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        if ($request->isXmlHttpRequest()) {
            return response($response, 200);
        }

        return $this->success($request, $response);
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        if ($request->isXmlHttpRequest()) {
            return response(null, 422);
        }

        return $this->error($request, $response);
    }
}
