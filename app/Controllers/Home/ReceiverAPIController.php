<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemDetail;
use App\Models\Result;

class ReceiverAPIController extends Controller
{
    public function generateJson($response, $success, $message, $param = null)
    {
        $return_message["success"] = $success;
        $return_message["content"] = $message;
        $return_message["param"] = $param;
        return $response->withJson($return_message);
    }

    /**
     * @param $request
     * @param $response
     * @return mixed
     */
    public function getFormDetail($request, $response)
    {
        $arr = [];
        $id = $request->getParam('id');
        $query = ItemDetail::where('item_id', $id)->select('id', 'item_text', 'item_type')->get();
        foreach ($query as $key => $value) {
            if ($key = 'item_text') {
                $param = $value[$key];
                $arr[$param] = $request->getParam($param);
            }
        }

        $result = new Result();
        $result->create([
            'item_id' => $id,
            'text' => json_encode($arr),
        ]);

        return $this->generateJson($response, '1', $arr);
    }
}