<?php

namespace App\Http\Controllers;

use App\Dto\GetClientsDto;
use App\Http\Requests\Clients\ClientsListRequest;
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
            'client' => null,
        ]);
    }

    /**
     * Добавить клиента
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'client' => null,
        ]);
    }

    /**
     * Обновить клиента
     *
     * @param Request $request
     * @param int     $client_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $client_id)
    {
        return response()->json([
            'status' => 'success',
            'client' => null,
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
        return response()->json([
            'status' => 'success',
        ]);
    }
}
