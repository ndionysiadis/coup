<?php

namespace App\Http\Controllers;

use App\Data\Category\CategoryData;
use App\Data\Category\CategoryIndexPageData;
use App\Data\Category\CategoryShowPageData;
use App\Data\ToastData;
use App\Models\Category;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class CategoryController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Category/Index', new CategoryIndexPageData());
    }

    public function create()
    {
        return Inertia::render('Category/Create', [
            'category' => CategoryData::empty()
        ]);
    }

    public function store(CategoryData $request)
    {
        $category = Category::create($request->toDatabase());

        return redirect()
            ->route('category.show', $category)
            ->with([
                'toast' => ToastData::success(
                    'Η κατηγορία δημιουργήθηκε με επιτυχία.'
                )
            ]);
    }

    public function show(Category $category): Response
    {
        return Inertia::render('Category/Show', new CategoryShowPageData($category));
    }

    public function edit(Category $category): Response
    {
        return Inertia::render('Category/Edit', [
            'category' => CategoryData::from($category)
        ]);
    }

    /**
     * @throws Throwable
     */
    public function update(CategoryData $request, Category $category)
    {
        $category->update($request->toDatabase());

        return redirect()
            ->route('category.show', $category)
            ->with([
                'toast' => ToastData::success(
                    'Η κατηγορία ενημερώθηκε με επιτυχία.'
                )
            ]);
    }

    /**
     * @throws Throwable
     */
    public function destroy(Category $category)
    {

        $category->delete();

        return redirect()
            ->route('category.index')
            ->with([
                'toast' => ToastData::success(
                    'Η κατηγορία διαγράφτηκε με επιτυχία.'
                )
            ]);
    }
}
