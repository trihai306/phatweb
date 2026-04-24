<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Setting;
use App\Models\FoodMenu;
use App\Models\CompanyInfo;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class ServiceController extends Controller
{
    public function index()
    {
        $brandName = CompanyInfo::getValue('brand_name', 'PhatFood');
        SEOMeta::setTitle("Dịch vụ - {$brandName} Việt Nam");
        SEOMeta::setDescription(Setting::get('seo_description', 'PhatFood cung cấp dịch vụ suất ăn công nghiệp chất lượng cao, an toàn vệ sinh thực phẩm với thực đơn phù hợp đặc trưng từng vùng miền.'));
        OpenGraph::setTitle("Dịch vụ - {$brandName}");

        return view('services.index', [
            'services' => Service::active()->ordered()->get(),
            'menus' => FoodMenu::active()->orderBy('sort_order')->get(),
        ]);
    }

    public function show(string $slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        SEOMeta::setTitle(($service->meta_title ?: $service->title) . ' - PhatFood');
        SEOMeta::setDescription($service->meta_description ?: $service->description);

        return view('services.show', [
            'service' => $service,
            'services' => Service::active()->ordered()->get(),
        ]);
    }

    public function menu()
    {
        $brandName = CompanyInfo::getValue('brand_name', 'PhatFood');
        SEOMeta::setTitle("Thực đơn - {$brandName} Việt Nam");
        SEOMeta::setDescription(Setting::get('seo_description', 'PhatFood cung cấp dịch vụ suất ăn công nghiệp chất lượng cao, an toàn vệ sinh thực phẩm với thực đơn phù hợp đặc trưng từng vùng miền.'));

        return view('services.menu', [
            'menus' => FoodMenu::active()->orderBy('sort_order')->get(),
            'services' => Service::active()->ordered()->get(),
        ]);
    }
}
