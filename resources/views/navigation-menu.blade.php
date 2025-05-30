<nav class="bg-white shadow-md p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="/" class="text-xl font-bold text-gray-900 flex items-center">
            Sonic
        </a>

        <ul class="hidden md:flex space-x-6 text-gray-700">
            <li><a href="/products" class="hover:text-black">Tous les produits</a></li>
            <li><a href="/deals" class="text-red-500 hover:text-red-700">Bons plans</a></li>
            <li><a href="{{ route('contact') }}" class="hover:text-black">Besoin d’aide ?</a></li>
        </ul>

        <div x-data="searchComponent()" class="relative w-1/3">
            <input
                type="text"
                x-model="search"
                @input.debounce.500="fetchResults"
                placeholder="Que cherchez-vous ?"
                class="border border-gray-300 rounded-full px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-gray-400">

            <div x-show="loading" class="absolute right-2 top-2">
                <svg class="animate-spin h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
            </div>

            <ul x-show="search.length > 0 && results.length > 0" class="absolute bg-white border mt-2 w-full shadow-md rounded-lg max-h-60 overflow-auto z-50">
                <template x-for="result in results" :key="result.id">
                    <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer" @click="window.location.href = '/products/' + result.id">
                        <a :href="'/products/' + result.id" x-text="result.name"></a>
                    </li>
                </template>
                <li x-show="results.length === 0" class="px-4 py-2 text-gray-500">Aucun résultat trouvé</li>
            </ul>
        </div>

        <div class="flex space-x-4 items-center">
            <a href="{{ route('profile.index') }}" class="text-gray-700 hover:text-black">
                <svg aria-hidden="true" fill="currentColor" height="24" viewBox="0 0 48 48" width="24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 md:w-6 md:h-6">
                    <path d="M24 26a11 11 0 1111-11 11 11 0 01-11 11Zm0-20a9 9 0 109 9 9 9 0 00-9-9Zm19 38a1 1 0 01-1-1v-1a11 11 0 00-11-11H17A11 11 0 006 42v1a1 1 0 01-2 0v-1a13 13 0 0113-13h14a13 13 0 0113 13v1a1 1 0 01-1 1Z"></path>
                </svg>
            </a>
            <a href="/cart" class="text-gray-700 hover:text-black relative">
                <svg aria-hidden="true" fill="currentColor" height="24" viewBox="0 0 48 48" width="24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-5 md:w-6 md:h-6">
                    <path d="M37.26 44H10.74a3 3 0 01-3-3V15a3 3 0 013-3h26.52a3 3 0 013 3v26a3 3 0 01-3 3ZM10.74 14a1 1 0 00-1 1v26a1 1 0 001 1h26.52a1 1 0 001-1V15a1 1 0 00-1-1Z"></path>
                    <path d="M31 13a1 1 0 01-1-1 6 6 0 10-12 0 1 1 0 01-2 0 8 8 0 0116 0 1 1 0 01-1 1Z"></path>
                </svg>
            </a>

            @can('access-admin-dashboard')
                <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-black flex items-center px-3 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                    <svg class="w-5 h-5 md:w-6 md:h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0 4h2v-2H3v2zM3 9h2V7H3v2zm4 8h14V5H7v12zm0 4h14v-2H7v2zm16-18H5v18h18V3z"/>
                    </svg>
                    <span>Admin</span>
                </a>
            @endcan

            @auth()
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-gray-700 flex items-center px-3 py-2 text-black rounded-lg">
                    <svg class="w-5 h-5 md:w-6 md:h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M10.09 15.59L12.67 18.17 17 14 12.67 9.83 10.09 12.41 10.09 4 8 4 8 12.41 5.41 9.83 4 11.25 8 15.25 8 20 10.09 20 10.09 15.59zM19 20H13V22H19C20.1 22 21 21.1 21 20V4C21 2.9 20.1 2 19 2H13V4H19V20Z"/>
                    </svg>
                    <span>Déconnexion</span>
                </button>
            </form>
            @endauth
        </div>
    </div>
</nav>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('searchComponent', () => ({
            search: '',
            results: [],
            loading: false,
            fetchResults() {
                if (this.search.length < 2) {
                    this.results = [];
                    return;
                }
                this.loading = true;
                fetch(`/search?q=${this.search}`)
                    .then(res => res.json())
                    .then(data => {
                        this.results = data;
                        this.loading = false;
                    })
                    .catch(() => this.loading = false);
            }
        }));
    });
</script>
