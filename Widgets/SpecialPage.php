<?php

namespace Tee\Page\Widgets;

use View, Config;
use Tee\Page\Models\Page;


class SpecialPage {

    public function register($pageTag)
    {
        $page = Page::where('special', '=', $pageTag)->first();
        return View::make(
            'page::widgets.specialPage.specialPage',
            compact('page')
        );
    }

} 
