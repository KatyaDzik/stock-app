<?php

namespace App\Services;

use App\Dto\CustomerDto;
use App\Dto\InvoiceDto;
use App\Dto\ProviderDto;
use App\Enums\StatusEnums;
use App\Enums\TypeEnums;
use App\Exceptions\ModelNotCreatedException;
use App\Exceptions\ModelNotDeletedException;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\ModelNotUpdatedException;
use App\Models\Invoice;
use App\Repositories\CustomerRepository;
use App\Repositories\InvoiceRepository;
use App\Repositories\ProviderRepository;
use App\Repositories\ReceiptOfProductsRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class InvoiceService
 * @package App\Services
 */
class InvoiceService
{
    private InvoiceRepository $repository;

    /**
     * @param InvoiceRepository $repository
     */
    public function __construct(InvoiceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $count
     * @return LengthAwarePaginator
     */
    public function getAllPaginate(int $count): LengthAwarePaginator
    {
        return $this->repository->getAllPaginate($count);
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    /**
     * @param array $data
     * @return void
     */
    public function create(array $data): void
    {
        DB::transaction(function () use ($data) {
            $provider_repository = new ProviderRepository();
            $provider = $provider_repository->getByName($data['provider']);

            if (!$provider) {
                $provider = $provider_repository->save(new ProviderDto($data['provider'], auth()->user()->id));
            }

            $customer_repository = new CustomerRepository();
            $customer = $customer_repository->getByName($data['customer']);

            if (!$customer) {
                $customer = $customer_repository->save(new CustomerDto($data['customer'], auth()->user()->id));
            }

            $dto = new InvoiceDto(
                $data['number'],
                $data['date'],
                $data['from'],
                $data['to'],
                $provider->id,
                $customer->id,
                $data['type_id'],
                StatusEnums::PACKED,
                false
            );

            try {
                $this->repository->save($dto);
            } catch (\Exception $exception) {
                throw new ModelNotCreatedException();
            }
        });
    }

    /**
     * @param int $id
     * @return Invoice
     */
    public function read(int $id): Invoice
    {
        try {
            return $this->repository->getById($id);
        } catch (\Exception $e) {
            throw new ModelNotFoundException();
        }
    }

    /**
     * @param int $id
     * @param array $data
     * @return void
     */
    public function update(int $id, array $data): void
    {
        DB::transaction(function () use ($id, $data) {
            $invoice = $this->repository->getById($id);

            if ($invoice->type_id === TypeEnums::INCOMING && $data['status_id'] === StatusEnums::DELIVERED) {
                $service = app()->make(ReceiptOfProductsService::class);
                $service->createFromInvoice($id);
            }

            $dto = new InvoiceDto(
                $data['number'],
                $data['date'],
                $data['from'],
                $data['to'],
                $invoice->provider_id,
                $data['customer_id'],
                $invoice->type_id,
                $data['status_id'],
                $data['closed']
            );

            try {
                $this->repository->update($id, $dto);
            } catch (\Exception $e) {
                throw new ModelNotUpdatedException();
            }
        });
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        try {
            $this->repository->delete($id);
        } catch (\Exception $e) {
            throw new ModelNotDeletedException();
        }
    }
}
