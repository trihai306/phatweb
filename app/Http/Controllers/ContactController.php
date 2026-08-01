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
    /** Chủ đề hợp lệ của form hỏi trực tuyến: slug => nhãn hiển thị. */
    public const SUBJECTS = [
        'dich-vu' => 'Tư vấn dịch vụ',
        'bao-gia' => 'Yêu cầu báo giá',
        'tuyen-dung' => 'Tuyển dụng',
        'hop-tac' => 'Hợp tác kinh doanh',
        'khieu-nai' => 'Khiếu nại / Phản hồi',
        'khac' => 'Khác',
    ];

    public function index()
    {
        $brandName = CompanyInfo::getValue('brand_name', 'DAT PHAT');
        SEOMeta::setTitle("Liên lạc với chúng tôi - {$brandName} NUTRITION");
        SEOMeta::setDescription(Setting::get('seo_description', 'DAT PHAT cung cấp dịch vụ suất ăn công nghiệp chất lượng cao, an toàn vệ sinh thực phẩm với thực đơn phù hợp đặc trưng từng vùng miền.'));
        OpenGraph::setTitle("Liên lạc - {$brandName}");

        return view('contact.index', [
            'companyInfo' => CompanyInfo::all()->pluck('value', 'key'),
        ]);
    }

    public function inquiry(Request $request)
    {
        $brandName = CompanyInfo::getValue('brand_name', 'DAT PHAT');
        SEOMeta::setTitle("Hỏi trực tuyến - {$brandName} NUTRITION");
        SEOMeta::setDescription(Setting::get('seo_description', 'DAT PHAT cung cấp dịch vụ suất ăn công nghiệp chất lượng cao, an toàn vệ sinh thực phẩm với thực đơn phù hợp đặc trưng từng vùng miền.'));

        return view('contact.inquiry', [
            'companyInfo' => CompanyInfo::all()->pluck('value', 'key'),
            'subjects' => self::SUBJECTS,
            'selectedSubject' => $this->resolveSubject(
                old('subject', $request->query('subject', ''))
            ),
        ]);
    }

    /**
     * Đưa chủ đề đến từ query string (vd "Ứng tuyển: Đầu bếp" từ trang tuyển dụng)
     * về đúng một slug có trong danh sách, nếu không thì để trống.
     */
    private function resolveSubject(mixed $subject): string
    {
        $subject = is_string($subject) ? $subject : '';

        if (array_key_exists($subject, self::SUBJECTS)) {
            return $subject;
        }

        if (str_contains($subject, 'Ứng tuyển')) {
            return 'tuyen-dung';
        }

        return '';
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ], [
            'name.required' => 'Vui lòng nhập họ và tên.',
            'name.max' => 'Họ và tên không được vượt quá 255 ký tự.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
            'company.max' => 'Tên công ty không được vượt quá 255 ký tự.',
            'subject.max' => 'Chủ đề không được vượt quá 255 ký tự.',
            'message.required' => 'Vui lòng nhập nội dung.',
            'message.max' => 'Nội dung không được vượt quá 5000 ký tự.',
        ]);

        // Lưu nhãn tiếng Việt để admin đọc được thay vì slug ("bao-gia").
        $subject = $validated['subject'] ?? null;
        $validated['subject'] = $subject === null ? null : (self::SUBJECTS[$subject] ?? $subject);

        Contact::create($validated);

        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất.');
    }
}
