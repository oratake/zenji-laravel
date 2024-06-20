<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            ユーザー情報
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            ユーザー情報とメールアドレスを更新します
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="氏名" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="メールアドレス" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        メールアドレスが認証されていません

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            認証メールを再送する
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            新しい認証用メールを送信しました
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
        <x-input-label for="jiin_name" value="寺院名" />
            <x-text-input id="jiin_name" name="jiin_name" type="text" class="mt-1 block w-full" :value="old('jiin_name', $user->jiin_name)" />
            <x-input-error class="mt-2" :messages="$errors->get('jiin_name')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>更新</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >更新しました</p>
            @endif
        </div>
    </form>
</section>
