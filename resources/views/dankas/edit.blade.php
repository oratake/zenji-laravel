<x-guest-layout>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                檀家情報
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                檀家情報を更新します
            </p>
        </header>

        @if (session('status') === 'danka-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600"
            >更新しました</p>
        @endif

        @if (session('status') === 'require-email-or-phone-number')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                class="text-sm text-red-500"
            >メールアドレスか電話番号のどちらかは入力してください</p>
        @endif
        
        <form action="{{ route('dankas.update', ['id' => $danka->id]) }}" method="post" class="mt-6 space-y-6" >
            @csrf
            @method('patch')

            <!-- danka_id -->
            <input type="hidden" id="id" name="id" value="{{ $danka->id }}">

            <!-- family_head_last_name -->
            <div class="mt-4">
            <div class="flex items-center">
                <x-input-label for="family_head_last_name" value="代表者 姓" />
                <span class="text-red-500 text-sm ml-1">　　必須</span>
            </div>
            <x-text-input id="family_head_last_name" class="block mt-1 w-full" type="text" name="family_head_last_name" :value="old('family_head_last_name', $danka->family_head_last_name)" required autofocus />
            <x-input-error :messages="$errors->get('family_head_last_name')" class="mt-2" />
        </div>

        <!-- family_head_first_name -->
        <div class="mt-4">
            <div class="flex items-center">
                <x-input-label for="family_head_first_name" value="代表者 名" />
                <span class="text-red-500 text-sm ml-1">　　必須</span>
            </div>
            <x-text-input id="family_head_first_name" class="block mt-1 w-full" type="text" name="family_head_first_name" :value="old('family_head_first_name', $danka->family_head_first_name)" required />
            <x-input-error :messages="$errors->get('family_head_first_name')" class="mt-2" />
        </div>

        <!-- family_head_last_name_kana -->
        <div class="mt-4">
            <div class="flex items-center">
                <x-input-label for="family_head_last_name_kana" value="代表者 せい" />
                <span class="text-red-500 text-sm ml-1">　　必須</span>
            </div>
            <x-text-input id="family_head_last_name_kana" class="block mt-1 w-full" type="text" name="family_head_last_name_kana" :value="old('family_head_last_name_kana', $danka->family_head_last_name_kana)" required />
            <x-input-error :messages="$errors->get('family_head_last_name_kana')" class="mt-2" />
        </div>

        <!-- family_head_first_name_kana -->
        <div class="mt-4">
            <div class="flex items-center">
                <x-input-label for="family_head_first_name_kana" value="代表者 めい" />
                <span class="text-red-500 text-sm ml-1">　　必須</span>
            </div>
            <x-text-input id="family_head_first_name_kana" class="block mt-1 w-full" type="text" name="family_head_first_name_kana" :value="old('family_head_first_name_kana', $danka->family_head_first_name_kana)" required />
            <x-input-error :messages="$errors->get('family_head_first_name_kana')" class="mt-2" />
        </div>

        <div class="mt-8">
            <p class="text-sm ml-1">連絡が取れるようにするため、電話番号とメールアドレス、どちらかは<span class="text-red-500">必ず</span>ご登録をお願いいたします</p>
        </div>

        <!-- email -->
        <div class="mt-4">
            <x-input-label for="email" value="連絡用メールアドレス" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $danka->email)"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>        

        <!-- email_confirmation -->
        <div class="mt-4">
            <x-input-label for="email_confirmation" value="連絡用メールアドレス(確認用)" />

            <x-text-input id="email_confirmation" class="block mt-1 w-full"
                            type="email"
                            name="email_confirmation" 
                            :value="old('email_confirmation')"/>

            <x-input-error :messages="$errors->get('email_confirmation')" class="mt-2" />
        </div>

        <!-- phone_number -->
        <div class="mt-4">
            <x-input-label for="phone_number" value="電話番号 (市外局番からお入れください)" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="tel" name="phone_number" :value="old('phone_number', $danka->phone_number)" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>  

        <!-- postcode -->
        <div class="mt-8">
                <x-input-label for="postcode" value="郵便番号" />
                <x-text-input id="postcode" class="block mt-1 w-full" type="tel" name="postcode" :value="old('postcode', $danka->postcode)" />
                <x-input-error :messages="$errors->get('postcode')" class="mt-2" />
            </div>  

            <!-- address -->
            <div class="mt-4">
                <x-input-label for="address" value="住所" />
                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', $danka->address)" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>  
            
            <!-- note -->
            <div>       
            <x-input-label for="note" value="備考" />
                <textarea id="note" name="note" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" >{{ old('note', $danka->note) }}</textarea>
            </div> 

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    更新
                </x-primary-button>
            </div>
        </form>
        <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-danka-deletion')"
        >削除</x-danger-button>

        <x-modal name="confirm-danka-deletion" :show="$errors->dankaDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('dankas.destroy') }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900">
                    この檀家情報を削除しますか？
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    一度削除を実行すると、この檀家情報は完全に削除されます。よろしければ、パスワードを入力してください。
                </p>

                <div class="mt-6">
                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="パスワード"
                    />
                    <input type="hidden" id="id" name="id" value="{{ $danka->id }}">

                    <x-input-error :messages="$errors->dankaDeletion->get('password')" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        キャンセル
                    </x-secondary-button>

                    <x-danger-button class="ms-3">
                        檀家情報を削除する
                    </x-danger-button>
                </div>
            </form>
        </x-modal>

    </section>
</x-guest-layout>