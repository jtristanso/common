<?php

namespace Increment\Common\Rating\Http;

use Illuminate\Http\Request;
use App\Http\Controllers\APIController;
use Increment\Common\Rating\Models\Rating;
class RatingController extends APIController
{
    function __construct(){
      $this->model = new Rating();
    }

    public function create(Request $request){
      $data = $request->all();

      $result = Rating::where('account_id', '=', $data['account_id'])
      ->where('payload', '=', $data['payload'])->where('payload_value', '=', $data['payload_value'])->get();
      if(sizeof($result) > 0){
        $this->model = new Rating();
        $this->response['error']['message'] = "You've submitted reviews already.";
        $this->response['error']['status'] = 100;
      }else{
        $this->insertDB($data);
      }
      return $this->response();
    }

    public function retrieve(Request $request){
      $data = $request->all();
      $this->retrieveDB($data);
      $result = $this->response['data'];

      if(sizeof($result) > 0){
        $payload = $data['condition'][0]['value'];
        $payloadValue = $data['condition'][1]['value'];
        $avg = Rating::where('payload', '=', $payload)->where('payload_value', '=', $payloadValue)->avg('value');
        $total = Rating::where('payload', '=', $payload)->where('payload_value', '=', $payloadValue)->sum('value');
        $stars = round($avg);
        $this->response['total'] = $total;
        $this->response['avg'] = $avg;
        $this->response['stars'] = $stars;
      }
      $accountId = $data['account_id'];
      $payload = $data['condition'][0]['value'];
      $payloadValue = $data['condition'][1]['value'];
      $this->response['status'] = $this->checkAccountExist($accountId, $payload, $payloadValue);
      return $this->response();
    }

    public function checkAccountExist($accountId, $payload, $payloadValue){
      $result = Rating::where('account_id', '=', $accountId)
      ->where('payload', '=', $payload)
      ->where('payload_value', '=', $payloadValue)
      ->get();
      return (sizeof($result) > 0) ? true : false;
    }

    public function getRatingByPayload($payload, $payloadValue){
      $rating = Rating::where('payload', '=', $payload)->where('payload_value', '=', $payloadValue)->get();
      $avg = 0;
      $totalRating = 0;
      $size = sizeof($rating);
      if(sizeof($rating) > 0){
        $i = 0;
        foreach ($rating as $key) {
          $totalRating += intval($rating[$i]['value']);
          $i++;
        }
      }
      $avg = ($size > 0) ? floatval($totalRating / $size) : $totalRating;
      return array(
        'total' => $totalRating,
        'size'  => $size,
        'avg'   => $avg
      );
    }
}
