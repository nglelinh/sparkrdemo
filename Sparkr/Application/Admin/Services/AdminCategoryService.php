<?php

namespace Sparkr\Application\Admin\Services;

use Sparkr\Domain\MasterDataManagement\Category\Interfaces\CategoryRepositoryInterface;
use Sparkr\Domain\MasterDataManagement\Category\Models\Category;
use Illuminate\Http\Response;

class AdminCategoryService
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

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
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;

        $this->status = Response::HTTP_OK;
        $this->message = __('api_messages.successful');
    }

    /**
     */
    public function index(): array
    {
        $this->data =  $this->categoryRepository->index()->transform(function (Category $category) {
            return [
                'id' => $category->getId(),
                'name' => $category->getName(),
            ];
        })->toArray();
        return $this->handleApiResponse();
    }

    /**
     */
    public function create(array $param): array
    {
        $category = new Category($param['name']);
        $this->categoryRepository->save($category);

        return $this->handleApiResponse();
    }

    /**
     */
    public function update(int $id, array $param): array
    {

        $category = $this->categoryRepository->getById($id);
        $category->setName($param['name']);

        $this->categoryRepository->save($category);

        return $this->handleApiResponse();
    }

    /**
     */
    public function delete(int $id): array
    {
        $this->categoryRepository->delete($id);

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
