<?php

namespace App\Models\OAuth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OAuth\ClientInfo.
 *
 * @property int $id
 * @property int $client_id
 * @property string|null $description
 * @property string $logo_url
 * @method static \Illuminate\Database\Eloquent\Builder|ClientInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientInfo whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientInfo whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientInfo whereLogoUrl($value)
 * @mixin \Eloquent
 */
class ClientInfo extends Model
{
    use HasFactory;

    protected $table = 'oauth_clients_info';

    public $timestamps = false;

    protected $attributes = [
        'client_id',
        'description',
        'logo_url',
    ];
}
