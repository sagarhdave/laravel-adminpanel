<?php

namespace App\Repositories\Api\Page;

use App\Exceptions\GeneralException;
use App\Models\Pages\Page;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PageRepository.
 */
class PageRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Page::class;

    /**
     * Check given user is exist or not.
     *
     * @return mixed
     */
    public function findBySlug($page_slug)
    {
        if (count($this->query()->wherePage_slug($page_slug)->get()) > 0) {
            return $this->query()->wherePage_slug($page_slug)->get()->toArray();
        }

        throw new GeneralException(trans('exceptions.api.page.not_found'));
    }
}
