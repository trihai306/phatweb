<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Setting;
use App\Models\CompanyInfo;
use App\Models\HistoryMilestone;
use App\Models\Certificate;
use App\Models\Statistic;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class AboutController extends Controller
{
    public function index()
    {
        $brandName = CompanyInfo::getValue('brand_name', 'PhatFood');
        SEOMeta::setTitle("Về chúng tôi - {$brandName} Việt Nam");
        SEOMeta::setDescription(Setting::get('seo_description', 'PhatFood cung cấp dịch vụ suất ăn công nghiệp chất lượng cao, an toàn vệ sinh thực phẩm với thực đơn phù hợp đặc trưng từng vùng miền.'));
        OpenGraph::setTitle("Về chúng tôi - {$brandName}");

        return view('about.index', [
            'page' => Page::where('slug', 've-chung-toi')->first(),
            'companyInfo' => CompanyInfo::all()->pluck('value', 'key'),
            'statistics' => Statistic::active()->ordered()->get(),
            'sidebarPages' => Page::bySection('aboutus')->active()->orderBy('sort_order')->get(),
        ]);
    }

    public function show(string $slug)
    {
        $page = Page::where('slug', $slug)->where('section', 'aboutus')->firstOrFail();

        SEOMeta::setTitle(($page->meta_title ?: $page->title) . ' - PhatFood');
        SEOMeta::setDescription($page->meta_description ?: $page->excerpt);

        $view = match ($slug) {
            'lich-su' => 'about.history',
            'chung-nhan' => 'about.certificates',
            default => 'about.show',
        };

        $data = [
            'page' => $page,
            'sidebarPages' => Page::bySection('aboutus')->active()->orderBy('sort_order')->get(),
        ];

        if ($slug === 'lich-su') {
            $data['milestones'] = HistoryMilestone::ordered()->get();
        }
        if ($slug === 'chung-nhan') {
            $data['certificates'] = Certificate::active()->ordered()->get();
        }

        return view($view, $data);
    }
}
