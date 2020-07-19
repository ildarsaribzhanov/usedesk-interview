<?php

namespace App\Http\Controllers;

use App\Dto\CreateClientDto;
use App\Dto\GetClientsDto;
use App\Http\Requests\Api\Clients\ClientsListRequest;
use App\Http\Requests\Api\Clients\CreateClientRequest;
use App\Http\Requests\Api\Clients\UpdateClientRequest;
use App\Services\ClientService;
use Illuminate\Http\Request;

/**
 * Class ClientsController
 *
 * @package App\Http\Controllers
 */
class ClientsController extends Controller
{
    /** @var ClientService */
    private ClientService $clientService;

    /**
     * ClientsController constructor.
     *
     * @param ClientService $clientService
     */
    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * Получить список клиентов с фильтрами
     *
     * @param ClientsListRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(ClientsListRequest $request)
    {
        $dto = new GetClientsDto();

        $dto->page       = $request->get('page', 1);
        $dto->limit      = $request->get('limit', 30);
        $dto->search_by  = $request->get('search_by', 'all');
        $dto->search_str = $request->get('search_str');

        return response()->json([
            'status' => 'success',
            'list'   => $this->clientService->getList($dto),
        ]);
    }

    /**
     * Получить одного клиента по id
     *
     * @param int $client_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOne(int $client_id)
    {
        return response()->json([
            'status' => 'success',
            'client' => $this->clientService->findById($client_id),
        ]);
    }

    /**
     * Добавить клиента
     *
     * @param CreateClientRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateClientRequest $request)
    {
        $dto = new CreateClientDto();

        $dto->user_id    = $request->user()->id;
        $dto->f_name     = $request->get('first_name');
        $dto->l_name     = $request->get('last_name');
        $dto->email_list = array_unique($request->get('email_list'));
        $dto->phone_list = array_unique($request->get('phone_list'));

        return response()->json([
            'status' => 'success',
            'client' => $this->clientService->create($dto),
        ]);
    }

    /**
     * Обновить клиента
     *
     * @param UpdateClientRequest $request
     * @param int                 $client_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateClientRequest $request, int $client_id)
    {
        $dto = new CreateClientDto();

        $dto->id         = $client_id;
        $dto->f_name     = $request->get('first_name');
        $dto->l_name     = $request->get('last_name');
        $dto->email_list = array_unique($request->get('email_list'));
        $dto->phone_list = array_unique($request->get('phone_list'));

        return response()->json([
            'status' => 'success',
            'client' => $this->clientService->update($dto),
        ]);
    }

    /**
     * Удалить клиента
     *
     * @param int $client_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(int $client_id)
    {
        $this->clientService->delete($client_id);

        return response()->json([
            'status' => 'success',
        ]);
    }
}
