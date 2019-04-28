<?php

namespace Increment\Common\Comment\Models;

use Illuminate\Database\Eloquent\Model;
use App\APIModel;

class Comment extends APIModel
{
    protected $table = 'comments';
    protected $fillable = ['account_id', 'payload', 'payload_value', 'text'];
}

