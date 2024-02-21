<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('scraping.store') }}">
            @csrf
			<div class="mb-4">
				URL
				<input
					name="url"
					placeholder="{{ __('例）https://hoge') }}"
					class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
				>{{ old('url') }}</input>
				<x-input-error :messages="$errors->get('url')" class="mt-2" />
			</div>

			<div class="mb-4">
				CSSセレクター
				<input
					name="selector"
					placeholder="{{ __('CSSセレクター指定') }}"
					class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
				>{{ old('url') }}</input>
				<x-input-error :messages="$errors->get('selector')" class="mt-2" />
			</div>

			<div class="mb-4">
				プロパティ
				<input
					name="property"
					placeholder="{{ __('プロパティ指定') }}"
					class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
				>{{ old('url') }}</input>
				<x-input-error :messages="$errors->get('property')" class="mt-2" />
			</div>

            <x-primary-button class="mt-4">{{ __('スクレイピング実行') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>