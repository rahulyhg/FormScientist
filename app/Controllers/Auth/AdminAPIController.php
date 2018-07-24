<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemDetail;
use App\Models\Result;

class AdminAPIController extends Controller
{
    /**
     * A helper method to generate Json with the standard of following:
     * {
     *  "success" : "1",
     *  "content" : {
     *               "item1" : "xxx",
     *               "item2" : "xxx",
     *               "..."   : "..."
     *              }
     *  "param"   : ""
     * }
     *
     * @param object $response transfer from the upper method to generate the Json by using withJson method
     * @param string $success status of the result, 1: succeed , 0: failed
     * @param object $message can transfer an array or a string when javascript uses forEach to traversal
     * @param null $param a additional value if needs
     * @return as above
     */
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
     * @return as
     */
    public function getItemList($request, $response)
    {
        $data = Item::where('user_id', $this->auth->user()->id)->get();
        return $this->generateJson($response, '1', $data, '');
    }

    /**
     * @param $request
     * @param $response
     * @return mixed
     */
    public function postAddItem($request, $response)
    {
        $item = new Item();
        $result = $item->addItem(
            $this->auth->user()->id,
            $request->getParam('name'),
            $request->getParam('description')
        );
        if (!$result) {
            return $this->generateJson($response, '0', 'This item has not been created', '');
        }
        return $this->generateJson($response, '1', 'This item has been created', '');
    }

    /**
     * @param $request
     * @param $response
     * @return as
     */
    public function postUpdateItem($request, $response)
    {
        $item = new Item();
        $item->updateItem(
            $request->getParam('id'),
            $request->getParam('name'),
            $request->getParam('description')
        );
        return $this->generateJson($response, '1', 'This item has been updated', '');
    }

    /**
     * @param $request
     * @param $response
     * @return as
     */
    public function postDelItem($request, $response)
    {
        $item = new Item();
        $item->delItem(
            (int)$request->getParam('id')
        );
        return $this->generateJson($response, '1', 'This item has been deleted', '');
    }


    /**
     * Item Detail
     * @param $request
     * @param $response
     * @return as
     */
    public function getItemDetail($request, $response)
    {
        $data = ItemDetail::where('item_id', $request->getParam('id'))->get();
        return $this->generateJson($response, '1', $data, '');
    }

    public function checkAuth($item_id)
    {
        $count = Item::where([
            'user_id' => $this->auth->user()->id,
            'id' => $item_id,
        ])->count();

        return $count == 1;
    }

    /**
     * @param $request
     * @param $response
     * @return mixed
     */
    public function postAddText($request, $response)
    {
        //Check unauthorized access
        if (!$this->checkAuth($request->getParam('item_id'))) {
            return $this->generateJson($response, '0', 'Unauthorized access', '');
        }

        $item = new ItemDetail();
        $result = $item->addText(
            $request->getParam('item_id'),
            $request->getParam('text'),
            $request->getParam('type')
        );
        if (!$result) {
            return $this->generateJson($response, '0', 'This text has not been created', '');
        }
        return $this->generateJson($response, '1', 'This text has been created', '');
    }

    /**
     * @param $request
     * @param $response
     * @return as
     */
    public function postUpdateText($request, $response)
    {
        $item = new ItemDetail();
        $result = $item->updateText(
            $request->getParam('id'),
            $request->getParam('text'),
            $request->getParam('type')
        );
        if (!$result) {
            return $this->generateJson($response, '0', 'This text has not been updated', '');
        }
        return $this->generateJson($response, '1', 'This text has been updated', '');
    }

    /**
     * @param $request
     * @param $response
     * @return as
     */
    public function postDelText($request, $response)
    {
        $item = new ItemDetail();
        $result = $item->delText(
            (int)$request->getParam('id')
        );
        if (!$result) {
            return $this->generateJson($response, '0', 'This text has not been deleted', '');
        }
        return $this->generateJson($response, '1', 'This text has been deleted', '');
    }

    /**
     * @param $request
     * @param $response
     * @return as
     */
    public function getResultList($request, $response)
    {
        $data = Result::where('item_id', $request->getParam('id'))->get();
        return $this->generateJson($response, '1', $data, '');
    }


}