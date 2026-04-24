<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Strength;
use App\Models\Statistic;
use App\Models\CompanyInfo;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;

class HomeController extends Controller
{
    public function index()
    {
        $siteName = Setting::get('seo_title', 'PhatFood - Dịch vụ suất ăn công nghiệp hàng đầu Việt Nam');
        $siteDescription = Setting::get('seo_description', 'PhatFood cung cấp dịch vụ suất ăn công nghiệp chất lượng cao, an toàn vệ sinh thực phẩm với thực đơn phù hợp đặc trưng từng vùng miền.');
        $seoKeywords = Setting::get('seo_keywords', 'suất ăn công nghiệp, dịch vụ ăn uống, PhatFood, suất ăn doanh nghiệp');

        SEOMeta::setTitle($siteName);
        SEOMeta::setDescription($siteDescription);
        SEOMeta::setKeywords(array_map('trim', explode(',', $seoKeywords)));
        OpenGraph::setTitle($siteName);
        OpenGraph::setDescription($siteDescription);

        $ogImage = Setting::get('seo_og_image');
        if ($ogImage) {
            OpenGraph::addImage(url($ogImage));
        }

        JsonLd::setType('Organization');
        JsonLd::setTitle(Setting::get('seo_title', 'PhatFood'));

        return view('home', [
            'sliders' => Slider::active()->ordered()->get(),
            'services' => Service::active()->ordered()->get(),
            'strengths' => Strength::active()->ordered()->get(),
            'statistics' => Statistic::active()->ordered()->get(),
            'companyInfo' => CompanyInfo::all()->pluck('value', 'key'),
        ]);
    }
}
