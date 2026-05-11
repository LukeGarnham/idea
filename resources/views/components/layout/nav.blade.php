<nav class="border-b border-border px-6">
    <div class="max-w-7xl mx-auto h-16 flex items-center justify-between">
        <div>
            <a href="/" class="flex items-center gap-x-2">
                <img src="/images/logo.png" alt="Idea logo" width="50"><span class="italic text-xl font-bold">Idea</span>
            </a>
        </div>
        <div class="flex gap-x-5">
            @auth
                <a href="{{ route('profile.edit') }}" class="">Edit Profile</a>
                <form method="POST" action="/logout">
                    @csrf
                    @method('DELETE')
                    <button class="" data-test="logout-button">Log Out</button>
                </form>
            @else
                <a href="/login" class="">Sign In</a>
                <a href="/register" class="btn">Register</a>
            @endauth
        </div>
    </div>
</nav>
