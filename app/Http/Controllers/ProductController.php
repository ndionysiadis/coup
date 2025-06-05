<?php

namespace App\Http\Controllers;

use App\Data\Product\ProductData;
use App\Data\Product\ProductPageData;
use App\Data\ToastData;
use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Throwable;

class ProductController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Product/Index', new ProductPageData());
    }

    public function archived(): Response
    {
        return Inertia::render('Product/Archived', new ProductPageData(true));
    }

    public function create()
    {
        return Inertia::render('Product/Create', [
            'product' => ProductData::empty(),
        ]);
    }

    public function store(ProductData $productData, Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storePublicly('images/products', 'public');
            $productData->image = $request->file('image')->hashName();
        }

        $product = Product::create($productData->toDatabase());

        if ($request->input('create_new')) {
            return redirect()
                ->route('product.create')
                ->with([
                    'toast' => ToastData::success(
                        'Το προϊόν δημιουργήθηκε με επιτυχία και μπορείτε να δημιουργήσετε νέο.'
                    )
                ]);
        } else {
            return redirect()
                ->route('product.show', $product)
                ->with([
                    'toast' => ToastData::success(
                        'Το προϊόν δημιουργήθηκε με επιτυχία.'
                    )
                ]);
        }
    }

    public function show(Product $product): Response
    {
        return Inertia::render('Product/Show', [
            'product' => ProductData::from($product)
                ->include(
                    'category'
                )
        ]);
    }

    public function edit(Product $product): Response
    {
        return Inertia::render('Product/Edit', [
            'product' => ProductData::from($product)
                ->include(
                    'category'
                )
        ]);
    }

    /**
     * @throws Throwable
     */
    public function update(ProductData $requestData, Product $product)
    {
        if (request()->hasFile('image')) {
            request()->file('image')->storePublicly('images/products', 'public');
            $requestData->image = request()->file('image')->hashName();
        }

        $product->update($requestData->toDatabase());

        return redirect()
            ->route('product.show', $product)
            ->with([
                'toast' => ToastData::success(
                    'Το προϊόν ενημερώθηκε με επιτυχία.'
                )
            ]);
    }

    /**
     * @throws Throwable
     */
    public function destroy(Product $product)
    {

        $product->delete();

        return redirect()
            ->route('product.index')
            ->with([
                'toast' => ToastData::success(
                    'Το προϊόν διαγράφτηκε με επιτυχία.'
                )
            ]);
    }

    /**
     * @throws Throwable
     */
    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);

        if ($product->trashed()) {
            $product->restore();
        }

        return redirect()
            ->route('product.archived')
            ->with([
                'toast' => ToastData::success(
                    'Το προϊόν έχει αποκατασταθεί με επιτυχία.'
                )
            ]);
    }

    public function reorder(Product $product, Request $request)
    {
        foreach ($request->options as $index => $option) {
            Product::find($option['id'])
                ->update([
                    'order' => $index + 1
                ]);
        }

        return redirect()->back();
    }
}
