<?php

namespace App\Http\Controllers;

use App\Data\Menu\MenuTypeData;
use App\Data\Menu\MenuTypeIndexPageData;
use App\Data\Menu\MenuTypeShowPageData;
use App\Data\ToastData;
use App\Models\MenuType;
use App\Repositories\MenuRepository;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Throwable;

class MenuController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Menu/Index', new MenuTypeIndexPageData());
    }

    public function archived(): Response
    {
        return Inertia::render('Menu/Archived', new MenuTypeIndexPageData(true));
    }

    public function create()
    {
        return Inertia::render('Menu/Create', [
            'menuType' => MenuTypeData::empty()
        ]);
    }

    /**
     * @throws Throwable
     */
    public function store(MenuTypeData $menuTypeData)
    {
        MenuRepository::store($menuTypeData);

        if ($menuTypeData->create_new) {
            return redirect()
                ->route('menu.create')
                ->with([
                    'toast' => ToastData::success(
                        'Ο κατάλογος δημιουργήθηκε με επιτυχία και μπορείτε να δημιουργήσετε νέο.'
                    )
                ]);
        } else {
            return redirect()
                ->route('menu.index')
                ->with([
                    'toast' => ToastData::success(
                        'Ο κατάλογος δημιουργήθηκε με επιτυχία.'
                    )
                ]);
        }

    }

    public function show(MenuType $menuType): Response
    {
        return Inertia::render('Menu/Show', new MenuTypeShowPageData($menuType));
    }

    public function edit(MenuType $menuType): Response
    {
        return Inertia::render('Menu/Edit', [
            'menuType' => MenuTypeData::from($menuType)
                ->include('categories')
        ]);
    }

    /**
     * @throws Throwable
     */
    public function update(MenuTypeData $request, MenuType $menuType)
    {
        MenuRepository::update($request, $menuType);

        return redirect()
            ->route('menu.show', $menuType)
            ->with([
                'toast' => ToastData::success(
                    'Ο κατάλογος ενημερώθηκε με επιτυχία.'
                )
            ]);
    }

    /**
     * @throws Throwable
     */
    public function destroy(MenuType $menuType)
    {

        $menuType->delete();

        return redirect()
            ->route('menu.index')
            ->with([
                'toast' => ToastData::success(
                    'Ο κατάλογος διαγράφτηκε με επιτυχία.'
                )
            ]);
    }

    /**
     * @throws Throwable
     */
    public function restore($id)
    {
        $menuType = MenuType::onlyTrashed()->findOrFail($id);

        if ($menuType->trashed()) {
            $menuType->restore();
        }

        return redirect()
            ->route('menu.archived')
            ->with([
                'toast' => ToastData::success(
                    'Ο κατάλογος έχει αποκατασταθεί με επιτυχία.'
                )
            ]);
    }

    public function reorder(MenuType $menu, Request $request)
    {
        foreach ($request->options as $index => $option) {
            MenuType::find($option['id'])
                ->update([
                    'order' => $index + 1
                ]);
        }

        return redirect()->back();
    }
}
