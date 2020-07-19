<?php

namespace App\Services;


use App\Dto\CreateClientDto;
use App\Dto\GetClientsDto;
use App\Models\Client\Client;
use App\Models\Client\ClientEmail;
use App\Models\Client\ClientPhone;
use Illuminate\Database\Eloquent\Model;
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

    /**
     * Добавить клиента
     *
     * @param CreateClientDto $dto
     *
     * @return Client|null
     */
    public function create(CreateClientDto $dto)
    {
        $client = new Client();

        $client->fill($dto->toArray())->save();

        $this->updateEmailList($client->id, $dto->email_list);
        $this->updatePhoneList($client->id, $dto->phone_list);

        return $this->findById($client->id);
    }

    /**
     * Обновить email'ы клиента
     *
     * @param int   $client_id
     * @param array $email_list
     *
     * @return int
     */
    private function updateEmailList(int $client_id, array $email_list)
    {
        $updated = [];

        foreach ($email_list as $email) {
            $updated[] = [
                'client_id' => $client_id,
                'email'     => $email,
            ];
        }

        return ClientEmail::query()->insertOrIgnore($updated);
    }

    /**
     * Обновить телефоны клиента
     *
     * @param int   $client_id
     * @param array $phone_list
     *
     * @return int
     */
    private function updatePhoneList(int $client_id, array $phone_list)
    {
        $updated = [];

        foreach ($phone_list as $phone) {
            $updated[] = [
                'client_id' => $client_id,
                'phone'     => $phone,
            ];
        }

        return ClientPhone::query()->insertOrIgnore($updated);
    }

    /**
     * Поиск по id
     *
     * @param int $client_id
     *
     * @return Client|Model|null
     */
    public function findById(int $client_id)
    {
        return Client::with(['emails', 'phones'])->find($client_id);
    }
}