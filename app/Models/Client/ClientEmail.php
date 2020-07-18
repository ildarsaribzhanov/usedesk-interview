<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientEmail
 *
 * Email'ы клиента
 *
 * @package App\Models\Client
 *
 * @property string $email
 * @property int    $client_id
 */
class ClientEmail extends Model
{
    /** @var string */
    protected $table = 'client_emails';

    /** @var string[] */
    protected $primaryKey = ['email', 'client_id'];

    /** @var string[] */
    protected $fillable = [
        'email',
        'user_id'
    ];
}
