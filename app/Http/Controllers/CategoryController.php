<?php

namespace App\Http\Controllers;

use App\Data\Category\CategoryData;
use App\Data\Category\CategoryIndexPageData;
use App\Data\Category\CategoryShowPageData;
use App\Data\ToastData;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Throwable;

class CategoryController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Category/Index', new CategoryIndexPageData());
    }

    public function archived(): Response
    {
        return Inertia::render('Category/Archived', new CategoryIndexPageData(true));
    }

    public function create()
    {
        return Inertia::render('Category/Create', [
            'category' => CategoryData::empty()
        ]);
    }

    /**
     * @throws Throwable
     */
    public function store(CategoryData $categoryData)
    {
        CategoryRepository::store($categoryData);

        if ($categoryData->create_new) {
            return redirect()
                ->route('category.create')
                ->with([
                    'toast' => ToastData::success(
                        'Η κατηγορία δημιουργήθηκε με επιτυχία και μπορείτε να δημιουργήσετε νέα.'
                    )
                ]);
        } else {
            return redirect()
                ->route('category.index')
                ->with([
                    'toast' => ToastData::success(
                        'Η κατηγορία δημιουργήθηκε με επιτυχία.'
                    )
                ]);
        }
    }

    public function show(Category $category): Response
    {
        return Inertia::render('Category/Show', new CategoryShowPageData($category));
    }

    public function edit(Category $category): Response
    {
        return Inertia::render('Category/Edit', [
            'category' => CategoryData::from($category)
                ->include('products', 'menuType')
        ]);
    }

    /**
     * @throws Throwable
     */
    public function update(CategoryData $request, Category $category)
    {
        CategoryRepository::update($request, $category);

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

    /**
     * @throws Throwable
     */
    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);

        if ($category->trashed()) {
            $category->restore();
        }

        return redirect()
            ->route('category.archived')
            ->with([
                'toast' => ToastData::success(
                    'Η κατηγορία έχει αποκατασταθεί με επιτυχία.'
                )
            ]);
    }

    public function reorder(Category $category, Request $request)
    {
        foreach ($request->options as $index => $option) {
            Category::find($option['id'])
                ->update([
                    'order' => $index + 1
                ]);
        }

        return redirect()->back();
    }
}
