<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
@php
        // Fetch specific menu items by ID from the url_list table
        $clientLink = App\Models\admin\UrlList::find(102);  // Home link
        $awardsLink = App\Models\admin\UrlList::find(103);  // Our Products link
        $videoLink = App\Models\admin\UrlList::find(104);  // About link
        $newsletterLink = App\Models\admin\UrlList::find(105);  // Case Studies link
        $partnersLink = App\Models\admin\UrlList::find(106);  // Testimonials link
        // Fetch specific menu items by ID from the url_list table
        $homeLink = App\Models\admin\UrlList::find(95);  // Home link
        $productLink = App\Models\admin\UrlList::find(96);  // Our Products link
        $aboutLink = App\Models\admin\UrlList::find(97);  // About link
        $caseStudiesLink = App\Models\admin\UrlList::find(100);  // Case Studies link
        $testimonialsLink = App\Models\admin\UrlList::find(98);  // Testimonials link
        $updatesLink = App\Models\admin\UrlList::find(113);  // Updates link
        $contactLink = App\Models\admin\UrlList::find(101);  // Contact Us link
    @endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    

    @foreach($urls as $url)
    <url>
        <loc>{{ url($url->url) }}</loc>
        <lastmod>{{ $url->updated_at ? $url->updated_at->toAtomString() : now()->toAtomString() }}</lastmod>
        <priority>{{ $url->item_no }}</priority>
    </url>
    @endforeach


    @foreach($mainCategories as $mainCategory)
    <url>
        <loc>{{ url($mainCategory->slug) }}</loc>
        <lastmod>{{ $mainCategory->updated_at ? $mainCategory->updated_at->toAtomString() : now()->toAtomString() }}</lastmod>
        <priority>1</priority>
    </url>


    @if(count(getAllSubCategories($mainCategory->id)))
        @foreach(getAllSubCategories($mainCategory->id) as $subCategory)
        <url>
            <loc>{{ url($subCategory->slug) }}</loc>
            <lastmod>{{ $subCategory->updated_at ? $subCategory->updated_at->toAtomString() : now()->toAtomString() }}</lastmod>
            <priority>1</priority>
        </url>
        @endforeach
    @endif
    @endforeach

    @foreach($blogs as $blog)
    <url>
        <loc>{{ url($updatesLink->url . '/' . $blog->slug) }}</loc>
        <lastmod>{{ $blog->updated_at ? $blog->updated_at->toAtomString() : now()->toAtomString() }}</lastmod>
        <priority>1</priority>
    </url>
    @endforeach

</urlset>
