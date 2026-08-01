<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_inquiry_form_saves_every_field_including_company(): void
    {
        $response = $this->from(route('contact.inquiry'))->post(route('contact.store'), [
            'name' => 'Nguyễn Văn A',
            'email' => 'a@example.com',
            'phone' => '0901234567',
            'company' => 'Công ty TNHH ABC',
            'subject' => 'bao-gia',
            'message' => 'Xin báo giá suất ăn cho 500 người.',
        ]);

        $response->assertRedirect(route('contact.inquiry'));
        $response->assertSessionHas('success');

        $contact = Contact::sole();
        $this->assertSame('Nguyễn Văn A', $contact->name);
        $this->assertSame('a@example.com', $contact->email);
        $this->assertSame('0901234567', $contact->phone);
        $this->assertSame('Công ty TNHH ABC', $contact->company);
        $this->assertSame('Yêu cầu báo giá', $contact->subject);
        $this->assertSame('Xin báo giá suất ăn cho 500 người.', $contact->message);
        $this->assertFalse($contact->is_read);
    }

    public function test_quick_contact_form_saves_without_subject_or_company(): void
    {
        $this->from(route('contact.index'))->post(route('contact.store'), [
            'name' => 'Trần Thị B',
            'email' => 'b@example.com',
            'phone' => '0909999999',
            'message' => 'Liên hệ nhanh.',
        ])->assertRedirect(route('contact.index'))->assertSessionHas('success');

        $contact = Contact::sole();
        $this->assertNull($contact->subject);
        $this->assertNull($contact->company);
    }

    public function test_invalid_submission_is_rejected_and_input_is_kept(): void
    {
        $this->from(route('contact.inquiry'))->post(route('contact.store'), [
            'name' => '',
            'email' => 'khong-phai-email',
            'message' => '',
        ])->assertRedirect(route('contact.inquiry'))
            ->assertSessionHasErrors(['name', 'email', 'message']);

        $this->assertSame(0, Contact::count());
    }

    public function test_unknown_subject_value_is_stored_as_submitted(): void
    {
        $this->post(route('contact.store'), [
            'name' => 'Lê Văn C',
            'email' => 'c@example.com',
            'subject' => 'Ứng tuyển: Đầu bếp',
            'message' => 'Tôi muốn ứng tuyển.',
        ]);

        $this->assertSame('Ứng tuyển: Đầu bếp', Contact::sole()->subject);
    }

    public function test_inquiry_page_preselects_subject_from_query_string(): void
    {
        $this->get(route('contact.inquiry', ['subject' => 'bao-gia']))
            ->assertOk()
            ->assertSee('<option value="bao-gia" selected>Yêu cầu báo giá</option>', false);
    }

    public function test_inquiry_page_maps_career_link_to_recruitment_subject(): void
    {
        $this->get(route('contact.inquiry', ['subject' => 'Ứng tuyển: Đầu bếp']))
            ->assertOk()
            ->assertSee('<option value="tuyen-dung" selected>Tuyển dụng</option>', false);
    }

    public function test_old_input_with_quotes_and_newlines_does_not_break_the_alpine_component(): void
    {
        // Bảo vệ lỗi cũ: old() nhúng thẳng vào chuỗi JS nháy đơn => dấu ' hoặc xuống dòng
        // làm hỏng x-data, toàn bộ form ngừng hoạt động.
        $payload = [
            'name' => "O'Brien",
            'email' => 'not-an-email',
            'company' => "Cong ty 'ABC'",
            'message' => "Dòng 1\nDòng 2 có dấu ' và \"",
        ];

        foreach ([route('contact.inquiry'), route('contact.index')] as $from) {
            $html = $this->from($from)
                ->followingRedirects()
                ->post(route('contact.store'), $payload)
                ->assertOk()
                ->getContent();

            // Giá trị cũ phải được escape (') chứ không phải nháy đơn/xuống dòng thô,
            // nếu không biểu thức x-data sẽ lỗi cú pháp.
            $this->assertStringContainsString("name: 'O\\u0027Brien'", $html);
            $this->assertStringNotContainsString("name: 'O'Brien'", $html);
            $this->assertMatchesRegularExpression("/message: '[^'\n]*'/", $html);
        }
    }

    public function test_submit_button_is_not_disabled_before_the_form_submits(): void
    {
        // Bảo vệ lỗi cũ: @click="loading = true" cùng :disabled="loading" trên nút submit
        // khiến Alpine vô hiệu hoá nút trước khi trình duyệt gửi form => form không bao giờ gửi.
        $html = $this->get(route('contact.inquiry'))->assertOk()->getContent();

        $this->assertStringNotContainsString('@click="loading = true"', $html);
        $this->assertStringContainsString('@submit="loading = true"', $html);
    }
}
