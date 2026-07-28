<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Product;
// use App\Models\Service;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [];

        /*
        |--------------------------------------------------------------------------
        | Static Pages
        |--------------------------------------------------------------------------
        */
        $urls[] = [
            'loc' => url('/'),
            'lastmod' => now()->toDateString(),
            'priority' => '1.0',
            'changefreq' => 'weekly',
        ];

        $staticPages = [
            'about',
            'mainProducts',
            'service',
            'downloads',
            'contact',
            'blogs',
        ];

        foreach ($staticPages as $page) {
            $urls[] = [
                'loc' => url($page),
                'lastmod' => now()->toDateString(),
                'priority' => '0.8',
                'changefreq' => 'monthly',
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Services
        |--------------------------------------------------------------------------
        */
        // if (class_exists(Service::class)) {
        //     $services = Service::select('slug', 'updated_at')->get();

        //     foreach ($services as $service) {
        //         $urls[] = [
        //             'loc' => url('/service/' . $service->slug),
        //             'lastmod' => optional($service->updated_at)->toDateString(),
        //             'priority' => '0.9',
        //             'changefreq' => 'weekly',
        //         ];
        //     }
        // }

        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */
        if (class_exists(Product::class)) {
            $products = Product::select('slug', 'updated_at')->get();

            foreach ($products as $product) {
                $urls[] = [
                    'loc' => url('/product/' . $product->slug),
                    'lastmod' => optional($product->updated_at)->toDateString(),
                    'priority' => '0.9',
                    'changefreq' => 'weekly',
                ];
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Blogs
        |--------------------------------------------------------------------------
        */
        if (class_exists(Blog::class)) {
            $blogs = Blog::select('slug', 'updated_at')->get();

            foreach ($blogs as $blog) {
                $urls[] = [
                    'loc' => url('/blog/' . $blog->slug),
                    'lastmod' => optional($blog->updated_at)->toDateString(),
                    'priority' => '0.8',
                    'changefreq' => 'weekly',
                ];
            }
        }

        $content = view('website.sitemap', compact('urls'));

        return response($content, 200)
            ->header('Content-Type', 'application/xml');
    }
}
