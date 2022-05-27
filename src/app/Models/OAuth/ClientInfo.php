<?php

namespace App\Models\OAuth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientInfo extends Model
{
    use HasFactory;

    protected $table = 'oauth_clients_info';

    public $timestamps = false;

    protected $attributes = [
        'client_id',
        'description',
        'logo_url'
    ];
}
