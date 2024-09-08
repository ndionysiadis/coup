<?php

namespace App\Http\Controllers;

use App\Data\Menu\MenuTypeData;
use App\Data\Menu\MenuTypeIndexPageData;
use App\Data\Menu\MenuTypeShowPageData;
use App\Data\ToastData;
use App\Models\MenuType;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class MenuController extends Controller
{

    public function index(): Response
    {
        return Inertia::render('Menu/Index', new MenuTypeIndexPageData());
    }

    public function create()
    {
        return Inertia::render('Menu/Create', [
            'menuType' => MenuTypeData::empty()
        ]);
    }

    public function store(MenuTypeData $request)
    {
        $menuType = MenuType::create($request->toDatabase());

        return redirect()
            ->route('menu.show', $menuType)
            ->with([
                'toast' => ToastData::success(
                    'Το μενού δημιουργήθηκε με επιτυχία.'
                )
            ]);
    }

    public function show(MenuType $menuType): Response
    {
        return Inertia::render('Menu/Show', new MenuTypeShowPageData($menuType));
    }

    public function edit(MenuType $menuType): Response
    {
        return Inertia::render('Menu/Edit', [
            'menuType' => MenuTypeData::from($menuType)
        ]);
    }

    /**
     * @throws Throwable
     */
    public function update(MenuTypeData $request, MenuType $menuType)
    {
        $menuType->update($request->toDatabase());

        return redirect()
            ->route('menu.show', $menuType)
            ->with([
                'toast' => ToastData::success(
                    'Το μενού ενημερώθηκε με επιτυχία.'
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
                    'Το μενού διαγράφτηκε με επιτυχία.'
                )
            ]);
    }
}
