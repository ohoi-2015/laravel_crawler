<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Scraping;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class ScrapingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user_id = Auth::id();
        // ユーザーが実行したスクレイピング結果を全て取得（並び順は作成日時の降順）
        $data = [
            'scraping'        => Scraping::whereHas('user', function ($query) use ($user_id) {
                                                        $query->where('user_id', $user_id);
                                                    })->where('user_id', $user_id)->latest()->lazy(10),
        ];
        return view('scraping.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'url'        => 'required|string|max:500|url',
            'basic_user' => 'nullable|string|max:200',
            'basic_pass' => 'nullable|string|max:200',
            'selector'   => 'required|string|max:500',
            'property'   => 'required|string|max:500',
        ]);

        $client = new Client();

        try
        {
            // クロール
            $response = $client->request(
                'GET',
                $validated['url'],
                ['auth' => [$validated['basic_user'] ?? '', $validated['basic_pass'] ?? '']],   // Basic認証設定
            );
        }
        catch (\Exception $e)
        {
            // スクロールエラー
            return redirect(route('scraping.index'))->with('is_scraping_err', true);
        }

        // 指定ページのHTMLをstring型で取得
        $html = $response->getBody()->getContents();

        // ページのDOM構成をいじる準備
        $crawler      = new Crawler($html);

        try
        {
            // CSSセレクタで要素指定し、さらにプロパティを指定する
            $scraping_results = $crawler->filter($validated['selector'])->attr($validated['property']);
        }
        catch (\Exception $e)
        {
            // 要素指定エラー
            return redirect(route('scraping.index'))->with('is_selector_err', true);
        }

        $insert = [
            'url'      => $validated['url'],
            'selector' => $validated['selector'],
            'property' => $validated['property'],
            'output'   => $scraping_results ?? '',
        ];

        // 取得したurlとcssセレクターを用いて取得したいプロパティ値をDB保存する
        $request->user()->scrapings()->create($insert);

        return redirect(route('scraping.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Scraping $scraping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Scraping $scraping)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Scraping $scraping)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Scraping $scraping): RedirectResponse
    {
        $this->authorize('delete', $scraping);

        $scraping->delete();

        return redirect(route('scraping.index'))->with('fix_delete', true);
    }
}
