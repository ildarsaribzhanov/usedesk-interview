<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Client
 *
 * Клиенты
 *
 * @package App\Models\Client
 *
 * @property int            $id
 * @property string         $first_name
 * @property string         $last_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 */
class Client extends Model
{
    use SoftDeletes;

    /** @var string */
    protected $table = 'clients';

    /**
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name'
    ];

    /**
     * Email'ы клиента
     */
    public function emails()
    {
        $this->hasMany(ClientEmail::class, 'client_id', 'id');
    }

    /**
     * Телефоны клиента
     */
    public function phones()
    {
        $this->hasMany(ClientPhone::class, 'client_id', 'id');
    }
}
