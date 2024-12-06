<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
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
        <loc>{{ url('latest/' . $blog->slug) }}</loc>
        <lastmod>{{ $blog->updated_at ? $blog->updated_at->toAtomString() : now()->toAtomString() }}</lastmod>
        <priority>1</priority>
    </url>
    @endforeach

</urlset>
