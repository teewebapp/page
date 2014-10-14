<?php

namespace Tee\Page\Controllers;

use Tee\System\Controllers\BaseController;

use Tee\Page\Models\Page;
use View, Input;

class PageController extends BaseController {

    /**
     * Show the page
     *
     * @return Response
     */
    public function show($slug)
    {
        $page = Page::where('slug', '=', $slug)->firstOrFail();

        $pageTitle = $page->title;
        $pageDescription = $page->description;
        $pageKeywords = $page->keywords;

        return View::make(
            'page::page.show',
            compact(
                'page', 'pageTitle', 'pageDescription', 'pageKeywords'
            )
        );
    }

}
