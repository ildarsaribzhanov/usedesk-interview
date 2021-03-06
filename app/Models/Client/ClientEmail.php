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
    protected $table = 'clients_emails';

    /** @var string[] */
    protected $primaryKey = ['email'];

    /** @var bool */
    public $incrementing = false;

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'email',
        'client_id'
    ];

    /** @var string[] */
    protected $hidden = ['client_id'];
}
