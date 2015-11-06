<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {   //>>.........调视图用...........
        $this->display('index');
    }
}