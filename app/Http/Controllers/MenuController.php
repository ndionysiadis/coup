<?php

namespace App\Http\Controllers;

use App\Data\MenuTypeData;
use App\Data\MenuTypePageData;
use App\Data\ToastData;
use App\Models\MenuType;
use App\Repositories\MenuRepository;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class MenuController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Menu/Index', new MenuTypePageData());
    }

    public function create()
    {
        return Inertia::render('Menu/Create');
    }

    public function show(MenuType $menuType): Response
    {
        return Inertia::render('Menu/Show', [
            'menuType' => MenuTypeData::from($menuType)
                ->include(
                    'categories',
                    'totalProducts'
                )
        ]);
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
    public function update(MenuTypeData $request, MenuType $menuType): RedirectResponse
    {
        return redirect()
            ->route('menu.show', $menuType)
            ->with(
                key: 'toast',
                value: ToastData::handle(
                    successMessage: 'Το option group ενημερώθηκε με επιτυχία.',
                    errorMessage: 'Δεν καταφέραμε να ενημερώσουμε το option group.',
                    callback: [(new MenuRepository($menuType)), 'update'],
                    args: [$request]
                )
            );
    }
}
