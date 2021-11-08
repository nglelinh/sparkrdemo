<?php

namespace Sparkr\Domain\MailsManagement\ConfirmRegistration\Services;

use App\Mail\ConfirmRegistrationMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class ConfirmRegistrationService
{
    /**
     *.
     */
    public function __construct()
    {
    }

    /**
     * @param array $emailData
     * @return JsonResponse
     */
    public function sendEmailConfirmRegistration(array $emailData): JsonResponse
    {
        Mail::send(new ConfirmRegistrationMail($emailData));

        if (empty(Mail::failures())) {
            return response()->json([
                                        'status' => 'error',
                                        'error' => Mail::failures()
                                    ]);
        }
        return response()->json([
                                    'status' => 'success',
                                ]);
    }
}
