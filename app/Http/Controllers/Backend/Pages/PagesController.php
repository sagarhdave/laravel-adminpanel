<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Pages\CreatePagesRequest;
use App\Http\Requests\Backend\Pages\DeletePagesRequest;
use App\Http\Requests\Backend\Pages\EditPagesRequest;
use App\Http\Requests\Backend\Pages\ManagePagesRequest;
use App\Http\Requests\Backend\Pages\StorePagesRequest;
use App\Http\Requests\Backend\Pages\UpdatePagesRequest;
use App\Models\Pages\Page;
use App\Repositories\Backend\Pages\PagesRepository;

/**
 * Class PagesController.
 */
class PagesController extends Controller
{
    /**
     * @var PagesRepository
     */
    protected $pages;

    /**
     * @param PagesRepository $pages
     */
    public function __construct(PagesRepository $pages)
    {
        $this->pages = $pages;
    }

    /**
     * @param ManagePagesRequest $request
     *
     * @return mixed
     */
    public function index(ManagePagesRequest $request)
    {
        return view('backend.pages.index');
    }

    /**
     * @param CreatePagesRequest $request
     *
     * @return mixed
     */
    public function create(CreatePagesRequest $request)
    {
        return view('backend.pages.create');
    }

    /**
     * @param StorePagesRequest $request
     *
     * @return mixed
     */
    public function store(StorePagesRequest $request)
    {
        $this->pages->create($request->all());

        return redirect()->route('admin.pages.index')->withFlashSuccess(trans('alerts.backend.pages.created'));
    }

    /**
     * @param Page             $page
     * @param EditPagesRequest $request
     *
     * @return mixed
     */
    public function edit(Page $page, EditPagesRequest $request)
    {
        return view('backend.pages.edit')
            ->withpage($page);
    }

    /**
     * @param Page             $page
     * @param EditPagesRequest $request
     *
     * @return mixed
     */
    public function update(Page $page, UpdatePagesRequest $request)
    {
        $this->pages->update($page, $request->all());

        return redirect()->route('admin.pages.index')->withFlashSuccess(trans('alerts.backend.pages.updated'));
    }

    /**
     * @param Permission            $permission
     * @param DeletePagesRequest $request
     *
     * @return mixed
     */
    public function destroy(Page $page, DeletePagesRequest $request)
    {
        $this->pages->delete($page);

        return redirect()->route('admin.pages.index')->withFlashSuccess(trans('alerts.backend.pages.deleted'));
    }
}
