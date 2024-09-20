<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            檀家一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('dankas.index') }}" method="get" class="mb-4">
                        <select name="disp_list" id="disp_list" value="" onchange="submit();">
                            @foreach($items_per_page_options as $key => $val)
                            @if ( request('disp_list') == $val)
                            <option value="{{ $val }}" selected>{{ $val }}</option>
                            @else
                            <option value="{{ $val }}">{{ $val }}</option>
                            @endif
                            @endforeach
                        </select>
                        件ずつ表示
                        <select name="sort_list" id="sort_list" value="" onchange="submit();">
                            <option value="newest" @if( request('sort_list')==='newest' ) selected @endif>登録の新しい順</option>
                            <option value="oldest" @if( request('sort_list')==='oldest' ) selected @endif>登録の古い順</option>
                            <option value="syllabary" @if( request('sort_list')==='syllabary' ) selected @endif>五十音順</option>
                        </select>
                    </form>
                    @if (session('status') === 'danka-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600">{{ session('danka')->family_head_last_name }}{{ session('danka')->family_head_first_name}}さんの情報を更新しました</p>
                    @endif
                    <table border="1" class="mb-4">
                        <tr>
                            <th>氏名</th>
                            <th>メールアドレス</th>
                            <th>電話番号</th>
                            <th>住所</th>
                            <th>備考</th>
                        </tr>
                        @foreach ($dankas as $danka)
                        <tr>
                            <th>{{ $danka->family_head_last_name }}{{ $danka->family_head_first_name }}</th>
                            <th>{{ $danka->email }}</th>
                            <th>{{ $danka->phone_number }}</th>
                            <th>{{ $danka->postcode }}{{ $danka->address }}</th>
                            <th>{{ $danka->note }}</th>
                            <th>
                                <a href="{{ route('dankas.edit', ['id' => $danka->id]) }}">編集</a>
                            </th>
                        </tr>
                        @endforeach
                    </table>
                    {{ $dankas->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>