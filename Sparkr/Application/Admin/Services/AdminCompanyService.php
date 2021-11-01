<?php

namespace Sparkr\Application\Admin\Services;

use Sparkr\Domain\ProfileManagement\CompanyProfile\Interfaces\CompanyProfileRepositoryInterface;
use Sparkr\Domain\ProfileManagement\CompanyProfile\Models\CompanyProfile;
use Illuminate\Http\Response;
use Sparkr\Domain\UserManagement\User\Interfaces\UserRepositoryInterface;
use Sparkr\Domain\UserManagement\User\Models\User;

class AdminCompanyService
{
    private CompanyProfileRepositoryInterface $companyProfileRepository;
    private UserRepositoryInterface $userRepository;

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
     * @param  CompanyProfileRepositoryInterface  $companyProfileRepository
     * @param  UserRepositoryInterface  $userRepository
     */
    public function __construct(
        CompanyProfileRepositoryInterface $companyProfileRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->companyProfileRepository = $companyProfileRepository;
        $this->userRepository = $userRepository;

        $this->status = Response::HTTP_OK;
        $this->message = __('api_messages.successful');
    }

    /**
     */
    public function getAllCompanyProfile(): array
    {
        $this->data =  $this->companyProfileRepository->getAllCompanyProfile()->transform(function (CompanyProfile $companyProfile) {
            return [
                'id' => $companyProfile->getId(),
                'email' => $companyProfile->getUser()->getEmail(),
                'phone' => $companyProfile->getPhone(),
                'company_website_url' => $companyProfile->getCompanyWebsiteUrl(),
                'employee_benefits' => $companyProfile->getEmployeeBenefits(),
                'category' => $companyProfile->getCategory()?->getName(),
                'status' => $companyProfile->getUser()?->getStatus(),
                'experience_level' => $companyProfile->getUser()?->getExperienceLevelId(),
            ];
        })->toArray();
        return $this->handleApiResponse();
    }

    /**
     */
    public function create(array $param): array
    {
        // create User
        $user = new User($param['email'],$param['password']);
        $userId = $this->userRepository->save($user)->getId();
        // create Company with FK user_id
        $newCompany = new CompanyProfile($userId, $param['category_id']);
        $this->companyProfileRepository->save($newCompany);

        return $this->handleApiResponse();
    }

    /**
     */
    public function update(int $id, array $param): array
    {

        $companyProfile = $this->companyProfileRepository->getById($id);
//        update some attributes
        $companyProfile->setPhone($param['phone']);
        $companyProfile->setCompanyWebsiteUrl($param['company_website_url']);
        $companyProfile->setEmployeeBenefits($param['employee_benefits']);
        $companyProfile->setCategoryId($param['category_id']);

        $this->companyProfileRepository->save($companyProfile);

        return $this->handleApiResponse();
    }

    /**
     */
    public function updateStatus(int $id): array
    {

        $companyProfile = $this->companyProfileRepository->getById($id);

        $companyProfile->getUser()->toggleStatus();

        $this->companyProfileRepository->save($companyProfile);

        return $this->handleApiResponse();
    }

    /**
     */
    public function delete(int $id): array
    {
        $this->companyProfileRepository->delete($id);

        return $this->handleApiResponse();
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
