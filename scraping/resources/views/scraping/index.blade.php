<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('scraping.store') }}">
            @csrf
			@if (session('is_scraping_err'))
				<span style="color:red;">スクリプトエラーです。URLやbasic認証を再確認してください。</span>
			@endif
			@if (session('is_selector_err'))
				<span style="color:red;">CSSセレクターエラーです。CSSセレクターを再確認してください。</span>
			@endif
			@if (session('fix_delete'))
				<span style="color:red;">データを削除しました。</span>
			@endif
			<div class="mb-4">
				<span style="color:red;">*</span>URL
				<input
					name="url"
					placeholder="{{ __('例）https://hoge') }}"
					class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
				><small>{{ old('url') }}</small></input>
				<x-input-error :messages="$errors->get('url')" class="mt-2" />
			</div>

			<div class="mb-4">
			    <small>Basic認証が必要な場合</small>
				<div class="mb-4">
					<input
						name="basic_user"
						placeholder="{{ __('user') }}"
						class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
					><small>{{ old('basic_user') }}<small></input>
					<x-input-error :messages="$errors->get('basic_user')" class="mt-2" />
				</div>
				<div>
				<input
					name="basic_pass"
					placeholder="{{ __('pass') }}"
					class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
				><small>{{ old('basic_pass') }}<small></input>
				<x-input-error :messages="$errors->get('basic_pass')" class="mt-2" />
				</div>
			</div>

			<div class="mb-4">
				<span style="color:red;">*</span>CSSセレクター
				<input
					name="selector"
					placeholder="{{ __('指定したい要素のselectorをコピーしてください。') }}"
					class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
				><small>{{ old('selector') }}<small></input>
				<x-input-error :messages="$errors->get('selector')" class="mt-2" />
			</div>

			<div class="mb-4">
				<span style="color:red;">*</span>プロパティ
				<input
					name="property"
					placeholder="{{ __('例）onmousedown') }}"
					class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
				><small>{{ old('property') }}<small></input>
				<x-input-error :messages="$errors->get('property')" class="mt-2" />
			</div>

            <x-primary-button class="mt-1">{{ __('スクレイピング実行') }}</x-primary-button>
        </form>

		<div class="mb-4 mt-6">
			<div class="mb-6 mt-6" style="border-top:1px solid #C0C0C0;"></div>
			<p>⇩並び順　　　: スクレイピング実行日 降順</p>
			<p>⇩最大表示数　: 10件</p>
		</div>
        @foreach ($scraping as $val)
			<div class="mt-4 bg-white shadow-sm rounded-lg divide-y">
                <div class="p-6 flex space-x-2">
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">{{ $val->user->name }}</span>
                                <small class="ml-2 text-sm text-gray-600">{{ $val->created_at->format('j M Y, g:i a') }}</small>
                            </div>
							@if ($val->user->is(auth()->user()))
								<form method="POST" action="{{ route('scraping.destroy', $val) }}">
									@csrf
									@method('delete')
									<x-delete-button>{{ __('削除') }}</x-delete-button>
								</form>
                            @endif
                        </div>
						<div class="justify-between">
							<p class="text-gray-800">{{ $val->url }}</p>
							<p class="text-gray-800">{{ $val->selector }}</p>
							<p class="text-gray-800">{{ $val->property }}</p>
						</div>
                        <p class="mt-4 text-lg text-gray-900">{{ empty($val->output) ? '指定プロパティが見当たりませんでした。' : $val->output }}</p>
                    </div>
                </div>
			</div>
        @endforeach
    </div>
</x-app-layout>