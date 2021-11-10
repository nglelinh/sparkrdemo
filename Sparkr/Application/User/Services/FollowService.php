<?php
namespace Sparkr\Application\User\Services;


use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Sparkr\Domain\UserManagement\User\Interfaces\UserRepositoryInterface;
use Sparkr\Domain\UserManagement\UserFollowing\Interfaces\UserFollowingRepositoryInterface;
use Sparkr\Domain\UserManagement\UserFollowing\Models\UserFollowing;
use Sparkr\Domain\UserManagement\UserFollowing\Services\UserFollowerDomainService;

class FollowService
{
    private UserRepositoryInterface $userRepository;
    private UserFollowingRepositoryInterface $userFollowerRepository;
    private UserFollowerDomainService $userFollowerDomainService;

    /**
     * @var int
     */
    private $status;

    /**
     * @var string
     */
    private $message;

    /**
     * @var array
     */
    private $data = [];

    /**
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        UserFollowingRepositoryInterface $userFollowerRepository,
        UserFollowerDomainService $userFollowerDomainService
    ) {
        $this->userRepository = $userRepository;
        $this->userFollowerRepository = $userFollowerRepository;
        $this->userFollowerDomainService = $userFollowerDomainService;

        $this->status = Response::HTTP_OK;
        $this->message = __('api_messages.successful');
    }

    public function follow(int $followerId, int $userId): array
    {
        DB::beginTransaction();
        try {
            $userFollower = new UserFollowing($followerId, $userId);
            $this->userFollowerRepository->save($userFollower);

            $user = $this->userRepository->getById($userId);
            $user->incrementFollower();
            $this->userRepository->save($user);

            $follower = $this->userRepository->getById($followerId);
            $follower->incrementFollowing();
            $this->userRepository->save($follower);
            DB::commit();
            return $this->handleApiResponse();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function unfollow(int $followerId, int $userId): array
    {
        DB::beginTransaction();
        try {
            $userFollower = $this->userFollowerRepository->getByUserId($userId, $followerId);
            $this->userFollowerRepository->delete($userFollower->getId());

            $user = $userFollower->getUser();
            $user->decrementFollower();
            $this->userRepository->save($user);
            $follower = $userFollower->getFollower();
            $follower->decrementFollowing();
            $this->userRepository->save($follower);
            DB::commit();
            return $this->handleApiResponse();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

    }

    /**
     * Format response data
     *
     * @return array
     */
    public function handleApiResponse(): array
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data
        ];
    }
}
