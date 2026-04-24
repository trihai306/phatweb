<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Service;
use App\Models\Strength;
use App\Models\Statistic;
use App\Models\CompanyInfo;

class ScrapedDataSeeder extends Seeder
{
    public function run(): void
    {
        $dataPath = base_path('scraper/data.json');

        if (!File::exists($dataPath)) {
            $this->command->warn('scraper/data.json not found. Run the scraper first: cd scraper && node scrape-welstory.js');
            return;
        }

        $data = json_decode(File::get($dataPath), true);

        if (isset($data['company_info']['stats'])) {
            $stats = $data['company_info']['stats'];
            $mappings = [
                'ceo' => ['key' => 'ceo', 'group' => 'general'],
                'founding_date' => ['key' => 'founded', 'group' => 'general'],
                'revenue' => ['key' => 'revenue', 'group' => 'general'],
                'employees' => ['key' => 'employees_count', 'group' => 'general'],
                'meals_per_day' => ['key' => 'meals_per_day', 'group' => 'general'],
                'canteen_count' => ['key' => 'canteen_count', 'group' => 'general'],
                'hq_address' => ['key' => 'address', 'group' => 'contact'],
            ];

            foreach ($mappings as $scraped => $config) {
                if (isset($stats[$scraped])) {
                    CompanyInfo::updateOrCreate(
                        ['key' => $config['key']],
                        ['value' => $stats[$scraped], 'group' => $config['group']]
                    );
                }
            }
        }

        if (isset($data['pages'])) {
            foreach ($data['pages'] as $pageData) {
                $url = $pageData['url'] ?? '';
                $section = 'aboutus';
                if (str_contains($url, '/services/')) $section = 'services';
                elseif (str_contains($url, '/whyus/')) $section = 'whyus';
                elseif (str_contains($url, '/careers/')) $section = 'careers';
                elseif (str_contains($url, '/contactus/')) $section = 'contact';

                $heading = $pageData['headings'][0] ?? null;
                $title = is_array($heading) ? ($heading['text'] ?? 'Untitled') : ($heading ?? $pageData['title'] ?? 'Untitled');
                $breadcrumbs = $pageData['breadcrumb'] ?? [];
                if ($title === 'Untitled' && !empty($breadcrumbs)) {
                    $title = end($breadcrumbs);
                }
                $rawContent = $pageData['contentText'] ?? ($pageData['content'] ?? '');
                if (is_array($rawContent)) {
                    $content = implode("\n", array_map(fn($t) => "<p>$t</p>", $rawContent));
                } else {
                    $paragraphs = array_filter(explode("\n", $rawContent), fn($l) => strlen(trim($l)) > 20);
                    $content = implode("\n", array_map(fn($t) => "<p>" . trim($t) . "</p>", $paragraphs));
                }

                Page::updateOrCreate(
                    ['slug' => \Str::slug($title)],
                    [
                        'title' => $title,
                        'content' => $content ?: null,
                        'section' => $section,
                        'meta_title' => $title . ' - DAT PHAT',
                    ]
                );
            }
        }

        $this->copyScrapedImages();

        $this->command->info('Scraped data imported successfully!');
    }

    private function copyScrapedImages(): void
    {
        $sourceDir = base_path('scraper/images');
        $targetDir = storage_path('app/public/scraped');

        if (!File::isDirectory($sourceDir)) return;

        File::ensureDirectoryExists($targetDir);

        foreach (File::files($sourceDir) as $file) {
            File::copy($file->getPathname(), $targetDir . '/' . $file->getFilename());
        }

        $this->command->info('Copied ' . count(File::files($sourceDir)) . ' images to storage.');
    }
}
