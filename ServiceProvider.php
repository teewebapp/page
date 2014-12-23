<?php

namespace Tee\Page;

use Tee\Page\Widgets\PageBoxList;
use Tee\System\Widget;
use Event;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot() 
    {
        $this->commands('Tee\Page\Commands\PagesReslug');
    }

    public function register()
    {
        $this->app->register('Cviebrock\EloquentSluggable\SluggableServiceProvider');
        $this->app->register('Codesleeve\LaravelStapler\LaravelStaplerServiceProvider');

        Event::listen('admin::menu.load', function($menu) {
            $format = '<img src="%s" class="fa" />&nbsp;&nbsp;<span>%s</span>';
            $menu->add(
                sprintf($format, moduleAsset('page', 'images/icon_page.png'), 'Páginas'),
                route('admin.page.index')
            );
        });
    }
}
