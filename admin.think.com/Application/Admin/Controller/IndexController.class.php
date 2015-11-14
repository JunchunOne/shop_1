<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {   //>>.........调视图用...........

        $this->display('index');
    }
    public function main()
    {   //>>.........调视图用...........

        $this->display('main');
    }

    public function menu()
    {
        if(superUser()){
                $menuModel=D('Menu');
                $menus=$menuModel->changPage('id,name,url,level,parent_id');
        }else {
            $ids = savePermissionID();
            if ($ids) {
                $str = implode(',', $ids);
                $sql = "select distinct m.id,m.name,m.url,m.level,m.parent_id from shop_menu as m join shop_menu_permission as mp on m.id = mp.menu_id  where mp.permission_id in ($str)";
                $menus = M()->query($sql);

            }
        }
        $this->assign('menus', $menus);
        $this->display('menu');
    }
}