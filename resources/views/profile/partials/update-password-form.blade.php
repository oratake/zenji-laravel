<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            パスワード変更
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            セキュリティ確保のため、複雑なパスワードを推奨します。
        </p>
        <p class="mt-1 text-sm text-gray-600">
            安全なパスワードを作る方法はこちらを参考にしてください。
        </p>
        <a href="https://www.ipa.go.jp/security/chocotto/" class="mt-1 text-sm text-gray-600 underline">独立行政法人 情報処理推進機構（IPA）</a>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" value="現在のパスワード" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" value="新しいパスワード" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" value="新しいパスワード(確認用)" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>変更</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >パスワードを変更しました</p>
            @endif
        </div>
    </form>
</section>
