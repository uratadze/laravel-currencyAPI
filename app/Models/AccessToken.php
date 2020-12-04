<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'accsess_token';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'token'];

    /**
     * Get current/auth user token.
     * 
     * @return string
     */
    public function getToken()
    {
        return $this->where('user_id', Auth::id())->get()[0]->token;
    }
}
