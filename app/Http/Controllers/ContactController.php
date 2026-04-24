<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Setting;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class ContactController extends Controller
{
    public function index()
    {
        $brandName = CompanyInfo::getValue('brand_name', 'DAT PHAT');
        SEOMeta::setTitle("Liên lạc với chúng tôi - {$brandName} Việt Nam");
        SEOMeta::setDescription(Setting::get('seo_description', 'DAT PHAT cung cấp dịch vụ suất ăn công nghiệp chất lượng cao, an toàn vệ sinh thực phẩm với thực đơn phù hợp đặc trưng từng vùng miền.'));
        OpenGraph::setTitle("Liên lạc - {$brandName}");

        return view('contact.index', [
            'companyInfo' => CompanyInfo::all()->pluck('value', 'key'),
        ]);
    }

    public function inquiry()
    {
        $brandName = CompanyInfo::getValue('brand_name', 'DAT PHAT');
        SEOMeta::setTitle("Hỏi trực tuyến - {$brandName} Việt Nam");
        SEOMeta::setDescription(Setting::get('seo_description', 'DAT PHAT cung cấp dịch vụ suất ăn công nghiệp chất lượng cao, an toàn vệ sinh thực phẩm với thực đơn phù hợp đặc trưng từng vùng miền.'));

        return view('contact.inquiry');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        Contact::create($validated);

        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất.');
    }
}
