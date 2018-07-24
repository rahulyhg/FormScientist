<?php

namespace app\Controllers\Auth;

use App\Controllers\Controller;

class AdminController extends Controller
{
    public function index($request, $response)
    {
        return $this->view->render($response,'admin/dashboard.twig');
    }
    public function items($request, $response)
    {
        return $this->view->render($response,'admin/items.twig');
    }
    public function Additem($request, $response)
    {
        return $this->view->render($response,'admin/addItem.twig');
    }
    public function itemPage($request, $response)
    {
        return $this->view->render($response,'admin/itemPage.twig');
    }
}