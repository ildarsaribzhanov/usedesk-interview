<?php

namespace App\Observers;

use App\Models\Client\Client;
use Log;
use Request;

/**
 * Class ClientObserver
 *
 * @package App\Observers
 */
class ClientObserver
{
    /**
     * Handle the client "created" event.
     *
     * @param Client $client
     *
     * @return void
     */
    public function created(Client $client)
    {
        $this->saveLog($client, 'Create new client');
    }

    /**
     * Handle the client "updated" event.
     *
     * @param Client $client
     *
     * @return void
     */
    public function updated(Client $client)
    {
        $this->saveLog($client, 'Update client');
    }

    /**
     * Handle the client "deleted" event.
     *
     * @param Client $client
     *
     * @return void
     */
    public function deleted(Client $client)
    {
        $this->saveLog($client, 'Delete client');
    }

    /**
     * Handle the client "restored" event.
     *
     * @param Client $client
     *
     * @return void
     */
    public function restored(Client $client)
    {
        $this->saveLog($client, 'Restored client');
    }

    /**
     * Handle the client "force deleted" event.
     *
     * @param Client $client
     *
     * @return void
     */
    public function forceDeleted(Client $client)
    {
        $this->saveLog($client, 'Force deleted client');
    }

    /**
     * @param Client $client
     * @param string $message
     */
    private function saveLog(Client $client, string $message): void
    {
        Log::info($message, ['client_id' => $client->id, 'author' => Request::user()->toArray()]);
    }
}
