<?php

namespace App\Events\Backend\Pages;

use Illuminate\Queue\SerializesModels;

/**
 * Class PageDeleted.
 */
class PageDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $pages;

    /**
     * @param $pages
     */
    public function __construct($pages)
    {
        $this->pages = $pages;
    }
}
