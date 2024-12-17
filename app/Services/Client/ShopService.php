<?php

namespace App\Services\Client;

use App\Models\AttributeValue;
use App\Models\Catalogue;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopService
{
    // Lấy 12 sản phẩm trang chủ
    public function getShopProducts($perPage, $sortBy)
    {
        $products = Product::with(['variants.variantAttributes.attributeValue'])
            ->where('is_active', 1);

        // Gọi hàm sắp xếp
        $this->applySorting($products, $sortBy);

        // Phân trang
        return $products->paginate($perPage);
    }

    public function getFilteredProducts($request, $perPage, $sortBy)
    {
        $products = Product::with(['variants.variantAttributes.attributeValue', 'catalogue'])
            ->where('is_active', 1); // Chỉ lấy sản phẩm đang hoạt động

        // dd($products);

        // Kiểm tra xem có bộ lọc nào được áp dụng hay không
        if ($request->has('danhmuc')) {
            $cate = Catalogue::where('slug', $request->input('danhmuc'))->first();
            // dd($request->has('categories'));
            $products->filterByCategory($cate->id);
        } else if ($request->has('gia')) {
            // dd('ok');
            $products->filterByPrice($request->input('gia'));
        } else if ($request->has('mau')) {
            $products->filterByAttributes($request->input('mau'));
        } else if ($request->has('kichco')) {
            $products->filterByAttributes($request->input('kichco'));
        }
        // dd($products->toSql(), $products->getBindings());
        // Gọi hàm sắp xếp
        $this->applySorting($products, $sortBy);

        // dd($products);

        // Phân trang
        return $products->paginate($perPage);
    }

    public function getCategories()
    {
        $categories = Catalogue::with(['children.products']) // Lấy danh mục con và sản phẩm
            ->where('parent_id', null) // Lấy danh mục cấp 1
            ->where('is_active', 1) // Chỉ lấy các danh mục đang hoạt động
            ->get();

        // Đếm số lượng sản phẩm trong mỗi danh mục con
        foreach ($categories as $category) {
            foreach ($category->children as $subcategory) {
                $subcategory->products_count = $subcategory->products()->count();
            }
        }

        return $categories;
    }

    public function getColorValues()
    {
        $colorValues = AttributeValue::whereHas('attribute', function ($query) {
            $query->where('name', 'color'); // Lọc theo tên thuộc tính
        })->get(['id', 'value', 'color_code']); // Lấy các trường cần thiết, bao gồm id

        return $colorValues;
    }
    public function getSizeValues()
    {
        $sizeValues = AttributeValue::whereHas('attribute', function ($query) {
            $query->where('name', 'size'); // Lọc theo tên thuộc tính
        })->get(['id', 'value']); // Lấy các trường cần thiết, bao gồm id

        return $sizeValues;
    }

    public function applySorting($query, $sortBy)
    {
        switch ($sortBy) {
            case 'title-ascending':
                $query->orderBy('name', 'asc');
                break;
            case 'title-descending':
                $query->orderBy('name', 'desc');
                break;
            case 'price-ascending':
                $query->orderBy('price_sale', 'asc');
                break;
            case 'price-descending':
                $query->orderBy('price_sale', 'desc');
                break;
            case 'created-ascending':
                $query->orderBy('created_at', 'asc');
                break;
            case 'created-descending':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('is_hot_deal', 'desc');
                break;
        }
    }

    public function getPerPage(Request $request)
    {
        return $request->input('ShowBy', 12); // Mặc định là 10
    }

    public function getSortBy(Request $request)
    {
        return $request->input('SortBy', 'featured'); // Mặc định là 'featured'
    }
}
