<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class ClientsController
 *
 * @package App\Http\Controllers
 */
class ClientsController extends Controller
{
    /**
     * Получить список клиентов с фильтрами
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'list'   => []
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
