<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PartnerCertificateQrTest extends TestCase
{
    use RefreshDatabase;

    /** Các đối tác có giấy tờ và file hồ sơ gộp tương ứng. */
    private const MERGED_FILES = [
        'dabaco-ho-so.pdf',
        'cidu-ho-so.pdf',
        'minh-ngoc-ho-so.pdf',
        'man-xuan-the-ho-so.pdf',
        'nguyen-my-linh-3-ho-so.pdf',
        'men-buoi-ho-so.pdf',
    ];

    public function test_partner_page_shows_a_qr_code_instead_of_document_links(): void
    {
        $response = $this->get(route('partners.index'));

        $response->assertOk();
        $response->assertSee('Hồ sơ pháp lý &amp; chứng nhận', false);
        $response->assertSee('Quét mã QR để xem hồ sơ', false);
        $response->assertSee('<svg', false);

        // Không còn link tải từng giấy tờ riêng lẻ.
        $response->assertDontSee('dabaco-attp.pdf');
        $response->assertDontSee('dabaco-dkkd.pdf');
        $response->assertDontSee('cidu-attp.pdf');
    }

    public function test_qr_code_can_be_enlarged_for_scanning(): void
    {
        $response = $this->get(route('partners.index'));

        $response->assertSee('Phóng to mã QR hồ sơ pháp lý', false);
        $response->assertSee('Quét mã QR bằng camera điện thoại để xem hồ sơ pháp lý &amp; chứng nhận.', false);
    }

    public function test_every_merged_certificate_file_exists_and_is_reachable(): void
    {
        foreach (self::MERGED_FILES as $file) {
            $this->assertFileExists(public_path("docs/certs/{$file}"));
        }
    }

    public function test_individual_certificate_files_are_no_longer_shipped(): void
    {
        $leftovers = glob(public_path('docs/certs/*.pdf'));
        $leftovers = array_map('basename', $leftovers ?: []);

        sort($leftovers);
        $expected = self::MERGED_FILES;
        sort($expected);

        $this->assertSame($expected, $leftovers);
    }
}
