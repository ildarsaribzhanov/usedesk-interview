<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientPhone
 *
 * Телефоны клиента
 *
 * @package App\Models\Client
 *
 * @property string $email
 * @property int    $client_id
 */
class ClientPhone extends Model
{
    /** @var string */
    protected $table = 'clients_phones';

    /** @var string[] */
    protected $primaryKey = ['phone'];

    /** @var bool */
    public $incrementing = false;

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'phone',
        'client_id'
    ];

    /** @var string[] */
    protected $hidden = ['client_id'];
}
