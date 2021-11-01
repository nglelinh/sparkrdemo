<?php

namespace Sparkr\Application\Admin\Services;

use Sparkr\Domain\MasterDataManagement\Trait\Interfaces\TraitRepositoryInterface;
use Sparkr\Domain\MasterDataManagement\Trait\Models\TraitModel;
use Illuminate\Http\Response;

class AdminTraitService
{
    /**
     * @var TraitRepositoryInterface
     */
    private $traitRepository;

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
    public function __construct(TraitRepositoryInterface $traitRepository)
    {
        $this->traitRepository = $traitRepository;

        $this->status = Response::HTTP_OK;
        $this->message = __('api_messages.successful');
    }

    /**
     */
    public function index(): array
    {
        $this->data =  $this->traitRepository->getAllTrait()->transform(function (TraitModel $trait) {
            return [
                'id' => $trait->getId(),
                'name' => $trait->getName(),
            ];
        })->toArray();
        return $this->handleApiResponse();
    }

    /**
     */
    public function create(array $param): array
    {
        $trait = new TraitModel($param['name']);
        $this->traitRepository->save($trait);

        return $this->handleApiResponse();
    }

    /**
     */
    public function update(int $id, array $param): array
    {

        $trait = $this->traitRepository->getById($id);
        $trait->setName($param['name']);

        $this->traitRepository->save($trait);

        return $this->handleApiResponse();
    }

    /**
     */
    public function delete(int $id): array
    {
        $this->traitRepository->delete($id);

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
