<?php

namespace Sparkr\Application\Admin\Services;

use Sparkr\Domain\ProfileManagement\CompanyProfile\Interfaces\CompanyProfileRepositoryInterface;
use Sparkr\Domain\ProfileManagement\CompanyProfile\Models\CompanyProfile;
use Illuminate\Http\Response;

class AdminCompanyService
{
    /**
     * @var CompanyProfileRepositoryInterface
     */
    private $companyProfileRepository;

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
    public function __construct(CompanyProfileRepositoryInterface $companyProfileRepository)
    {
        $this->companyProfileRepository = $companyProfileRepository;

        $this->status = Response::HTTP_OK;
        $this->message = __('api_messages.successful');
    }

    /**
     */
    public function index(): array
    {
        $this->data =  $this->companyProfileRepository->index()->transform(function (CompanyProfile $companyProfile) {
            return [
                'id' => $companyProfile->getId(),
                'phone' => $companyProfile->getPhone(),
                'company_website_url' => $companyProfile->getCompanyWebsiteUrl(),
                'employee_benefits' => $companyProfile->getEmployeeBenefits(),
                'category_id' => $companyProfile->getCategoryId(),
            ];
        })->toArray();
        return $this->handleApiResponse();
    }

    /**
     */
    public function create(array $param): array
    {
        $newCompany = new CompanyProfile($param['phone'], $param['company_website_url'], $param['employee_benefits'], $param['category_id']);
        $this->companyProfileRepository->save($newCompany);

        return $this->handleApiResponse();
    }

    /**
     */
    public function update(int $id, array $param): array
    {

        $companyProfile = $this->companyProfileRepository->getById($id);
        $companyProfile->setPhone($param['phone']);
        $companyProfile->setCompanyWebsiteUrl($param['company_website_url']);
        $companyProfile->setEmployeeBenefits($param['employee_benefits']);
        $companyProfile->setCategoryId($param['category_id']);

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
