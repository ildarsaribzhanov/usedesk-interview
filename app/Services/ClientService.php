<?php

namespace App\Services;


use App\Dto\GetClientsDto;
use App\Models\Client\Client;
use Illuminate\Support\Collection;

/**
 * Сервис работы с клиентами
 *
 * Class ClientService
 *
 * @package App\Services
 */
class ClientService
{
    /**
     * Выборка спика участников с фильтрацией
     *
     * @param GetClientsDto $dto
     *
     * @return Client[]|Collection
     */
    public function getList(GetClientsDto $dto)
    {
        return Client::all()->forPage($dto->page, $dto->limit);
    }
}