<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\View\View;

use App\Models\Scraping;

class ScrapingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // 保存してあるスクレイピング結果を全て取得（並び順は作成日時の降順）
        $data = [
            // 'scraping' => Scraping::with('user')->latest()->get(),
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
            'url'      => 'required|string|max:500|url',
            'selector' => 'required|string|max:500',
            'property' => 'required|string|max:500',
        ]);

        // 取得したurlとcssセレクターを用いて取得したいプロパティ値をDB保存する
        $request->user()->chirps()->create($validated);

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
    public function destroy(Scraping $scraping)
    {
        //
    }
}
