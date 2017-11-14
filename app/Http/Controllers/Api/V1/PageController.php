<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Api\Page\PageRepository;

class PageController extends Controller
{
    public function __construct(PageRepository $page)
    {
        $this->page = $page;
    }

    public function showPage($page_slug)
    {
        $result = $this->page->findBySlug($page_slug);

        return response()
                    ->json([
                        'status' => 'ok',
                        'data'   => $result,
                    ]);
    }
}
