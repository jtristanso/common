<?php

namespace Increment\Common\Comment\Http;

use Illuminate\Http\Request;
use App\Http\Controllers\APIController;
use Increment\Common\Comment\Models\CommentReply;
class CommentReplyController extends APIController
{
    function __construct(){
      $this->model = new CommentReply();
    }
}
