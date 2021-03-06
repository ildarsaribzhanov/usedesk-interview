<?php

namespace App\Services;


use App\Dto\CreateClientDto;
use App\Dto\GetClientsDto;
use App\Models\Client\Client;
use App\Models\Client\ClientEmail;
use App\Models\Client\ClientPhone;
use Illuminate\Database\Eloquent\Builder;
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
        $clients = Client::with(['emails', 'phones'])
            ->where('user_id', $dto->user_id);

        if ($dto->search_str) {
            $like_search = '%' . $dto->search_str . '%';

            switch ($dto->search_by) {
                case 'name':
                    $clients->where(function ($query) use ($like_search) {
                        $query->where('first_name', 'like', $like_search)
                            ->orWhere('last_name', 'like', $like_search);
                    });

                    break;

                case 'email':
                    $clients->whereHas('emails', function ($query) use ($like_search) {
                        $query->where('email', 'like', $like_search);
                    });
                    break;

                case 'phone':
                    $clients->whereHas('phones', function ($query) use ($like_search) {
                        $query->where('phone', 'like', $like_search);
                    });
                    break;

                default:
                    $clients->where(function (Builder $query) use ($like_search) {
                        $query->where('first_name', 'like', $like_search)
                            ->orWhere('last_name', 'like', $like_search)
                            ->orWhereHas('emails', function ($query) use ($like_search) {
                                $query->where('email', 'like', $like_search);
                            })->orWhereHas('phones', function ($query) use ($like_search) {
                                $query->where('phone', 'like', $like_search);
                            });
                    });
                    break;
            }
        }

        return $clients->get();
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
     * Обновить клиента
     *
     * @param CreateClientDto $dto
     *
     * @return Client
     */
    public function update(CreateClientDto $dto)
    {
        $client = $this->findById($dto->id);

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

    public function delete(int $client_id)
    {
        Client::query()->find($client_id)->delete();
        ClientEmail::query()->where('client_id', $client_id)->delete();
        ClientPhone::query()->where('client_id', $client_id)->delete();
    }
}