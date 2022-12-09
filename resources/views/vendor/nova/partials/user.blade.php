@php $username = $user->username ?? $user->email ?? __('User') @endphp
<dropdown-trigger class="h-9 flex items-center">
    @if (!empty($user->avatar))
        <img src="{{ $user->getThumbnailUrl('avatar') }}" alt="{{ $username }}" class="rounded-full w-8 h-8 mr-3" />
    @elseif (!empty($user->email))
        <img src="https://secure.gravatar.com/avatar/{{ md5(\Illuminate\Support\Str::lower($user->email)) }}?size=512" alt="{{ $username }}" class="rounded-full w-8 h-8 mr-3" />
    @endisset

    <span class="text-90">
        {{ $username }}
    </span>
</dropdown-trigger>

<dropdown-menu slot="menu" width="200" direction="rtl">
    <ul class="list-reset">
        <li>
            <a href="{{ route('nova.logout') }}" class="block no-underline text-90 hover:bg-30 p-3">
                {{ __('Logout') }}
            </a>
        </li>
    </ul>
</dropdown-menu>
