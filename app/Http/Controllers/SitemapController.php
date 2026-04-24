<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Service;
use App\Models\Strength;
use App\Models\Career;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create(route('home'))->setChangeFrequency('daily')->setPriority(1.0))
            ->add(Url::create(route('about.index'))->setChangeFrequency('monthly')->setPriority(0.8))
            ->add(Url::create(route('services.index'))->setChangeFrequency('monthly')->setPriority(0.8))
            ->add(Url::create(route('whyus.index'))->setChangeFrequency('monthly')->setPriority(0.8))
            ->add(Url::create(route('careers.index'))->setChangeFrequency('weekly')->setPriority(0.7))
            ->add(Url::create(route('contact.index'))->setChangeFrequency('monthly')->setPriority(0.6))
            ->add(Url::create(route('contact.inquiry'))->setChangeFrequency('monthly')->setPriority(0.5));

        Page::active()->get()->each(function ($page) use ($sitemap) {
            $sitemap->add(Url::create(route('about.show', $page->slug))->setChangeFrequency('monthly')->setPriority(0.6));
        });

        Service::active()->get()->each(function ($service) use ($sitemap) {
            $sitemap->add(Url::create(route('services.show', $service->slug))->setChangeFrequency('monthly')->setPriority(0.7));
        });

        Strength::active()->get()->each(function ($strength) use ($sitemap) {
            $sitemap->add(Url::create(route('whyus.show', $strength->slug))->setChangeFrequency('monthly')->setPriority(0.6));
        });

        Career::active()->get()->each(function ($career) use ($sitemap) {
            $sitemap->add(Url::create(route('careers.show', $career->slug))->setChangeFrequency('weekly')->setPriority(0.6));
        });

        return $sitemap->toResponse(request());
    }
}
