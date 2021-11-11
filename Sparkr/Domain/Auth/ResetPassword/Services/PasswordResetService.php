<?php

namespace Sparkr\Domain\Auth\ResetPassword\Services;


use App\Notifications\ResetPasswordRequest;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Sparkr\Domain\Auth\ResetPassword\Interfaces\PasswordResetRepositoryInterface;
use Sparkr\Domain\UserManagement\User\Interfaces\UserRepositoryInterface;
use Sparkr\Port\Secondary\Database\UserManagement\User\ModelDao\User;

class PasswordResetService
{
    private PasswordResetRepositoryInterface $passwordResetRepository;
    private UserRepositoryInterface $userRepository;

    public function __construct(
        PasswordResetRepositoryInterface $passwordResetRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->passwordResetRepository = $passwordResetRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Create token password reset.
     *
     * @param string $email
     * @return JsonResponse
     */
    public function sendMail(string $email): JsonResponse
    {
        /** @var User $user */
        $user = User::where('email', $email)->first();
        if (is_null($user)) {
            return response()->json([
                                        'status' => 'error',
                                        'message' => 'Not found User',
                                    ], 404);
        }
        $passwordReset = $this->passwordResetRepository->updateOrCreateTokenByEmail($user->getEmailForPasswordReset());
        if ($passwordReset) {
            $user->notify(new ResetPasswordRequest($passwordReset->token));
        }

        return response()->json([
                                    'status' => 'success',
                                    'message' => 'We have e-mailed your password reset link!'
                                ]);
    }

    /**
     * @param Request $request
     * @param $token
     * @return JsonResponse
     */
    public function submitResetPassword(Request $request, $token): JsonResponse
    {
        $checkTokenResult = $this->checkResetPasswordToken($token)->getData();
        $email = $checkTokenResult->data->email;
        $user = $this->userRepository->getByEmail($email);
        if (is_null($user)) {
            return response()->json([
                                        'status' => 'error',
                                        'message' => 'User not found',
                                    ], 404);
        }

        $user->setPassword(bcrypt($request->get('password')));
        $this->userRepository->save($user);
        $passwordDelete = $this->passwordResetRepository->delete($email);

        return response()->json([
                                    'status' => $passwordDelete ? "success" : "error",
                                    'message' => 'Change password successfully!',
                                ]);
    }

    /**
     * @param $token
     * @return JsonResponse
     */
    public function checkResetPasswordToken($token): JsonResponse
    {
        $passwordReset = $this->passwordResetRepository->getByToken($token);
        if (is_null($passwordReset)) {
            return response()->json([
                                        'status' => 'error',
                                        'message' => 'This password reset token is invalid.',
                                    ], 404);
        }

        $email = $passwordReset->getEmail();
        if (Carbon::parse($passwordReset->getUpdateAt())->addMinutes(30)->isPast()) {
            $this->passwordResetRepository->delete($email);

            return response()->json([
                                        'status' => 'error',
                                        'message' => 'This password reset token is invalid.',
                                    ], 422);
        }
        return response()->json([
                                    'status' => 'success',
                                    'message' => 'Valid token',
                                    'data' => [
                                        'email' => $email
                                    ],
                                ]);
    }

    /**
     * @param $token
     * @return JsonResponse
     */
    public function resetPassword($token): JsonResponse
    {
        return $this->checkResetPasswordToken($token);
    }
}
