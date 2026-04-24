<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Setting;
use App\Models\CompanyInfo;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class CareerController extends Controller
{
    public function index()
    {
        $brandName = CompanyInfo::getValue('brand_name', 'DAT PHAT');
        SEOMeta::setTitle("Tuyển dụng - {$brandName} Việt Nam");
        SEOMeta::setDescription(Setting::get('seo_description', 'DAT PHAT cung cấp dịch vụ suất ăn công nghiệp chất lượng cao, an toàn vệ sinh thực phẩm với thực đơn phù hợp đặc trưng từng vùng miền.'));
        OpenGraph::setTitle("Tuyển dụng - {$brandName}");

        return view('careers.index', [
            'careers' => Career::active()->latest()->paginate(12),
        ]);
    }

    public function show(string $slug)
    {
        $career = Career::where('slug', $slug)->firstOrFail();

        SEOMeta::setTitle(($career->meta_title ?: $career->title) . ' - Tuyển dụng DAT PHAT');
        SEOMeta::setDescription($career->meta_description ?: $career->description);

        return view('careers.show', [
            'career' => $career,
        ]);
    }
}
