<?php

namespace Tee\Page;

use Tee\Page\Widgets\PageBoxList;
use Widget;

class ServiceProvider extends \Illuminate\Support\ServiceProvider {

    public function register()
    {
        // registra os widgets
        Widget::register(
            'pageBoxList',
            __NAMESPACE__.'\\Widgets\\PageBoxList'
        );
    }
}