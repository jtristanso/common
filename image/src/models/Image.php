<?php

namespace Increment\Common\Image\Models;

use Illuminate\Database\Eloquent\Model;
use App\APIModel;

class Image extends APIModel
{
    protected $table = 'images';
    protected $fillable = ['account_id', 'payload', 'payload_value', 'status', 'url'];
}

