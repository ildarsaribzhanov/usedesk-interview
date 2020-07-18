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
    protected $table = 'client_phones';

    /** @var string[] */
    protected $primaryKey = ['phone', 'client_id'];

    /** @var string[] */
    protected $fillable = [
        'phone',
        'user_id'
    ];
}
