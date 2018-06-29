<?php


namespace app\controllers;



use shop\Cache;

class MainController extends AppController
{


    public function indexAction() {
        $brands = \R::find('brand', 'LIMIT 3');
        $hits = \R::find('product', "hit = '1' AND status = '1' LIMIT 8");
        //debugPrint($hits);
        //debugPrint($brands);
        $this->setMeta('Главная страница', 'Описание...', 'Ключи');
        $this->set(compact('brands', 'hits'));
    }
}