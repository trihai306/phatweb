<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Strength;
use App\Models\Statistic;
use App\Models\CompanyInfo;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class WhyUsController extends Controller
{
    public function index()
    {
        $brandName = CompanyInfo::getValue('brand_name', 'DAT PHAT');
        SEOMeta::setTitle("Tại sao là chúng tôi - {$brandName} Việt Nam");
        SEOMeta::setDescription(Setting::get('seo_description', 'DAT PHAT cung cấp dịch vụ suất ăn công nghiệp chất lượng cao, an toàn vệ sinh thực phẩm với thực đơn phù hợp đặc trưng từng vùng miền.'));
        OpenGraph::setTitle("Tại sao là chúng tôi - {$brandName}");

        return view('whyus.index', [
            'strengths' => Strength::active()->ordered()->get(),
            'statistics' => Statistic::active()->ordered()->get(),
        ]);
    }

    public function show(string $slug)
    {
        $strength = Strength::where('slug', $slug)->firstOrFail();

        SEOMeta::setTitle(($strength->meta_title ?: $strength->title) . ' - DAT PHAT');
        SEOMeta::setDescription($strength->meta_description ?: $strength->description);

        return view('whyus.show', [
            'strength' => $strength,
            'strengths' => Strength::active()->ordered()->get(),
        ]);
    }
}
