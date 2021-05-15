<x-app-layout>
    <x-slot name="header">
        <form class="d-flex mb-4" action=" {{ route('library.index') }} " method="GET">
            <input class="form-control me-2" type="search" placeholder="Search Book" aria-label="Search" name="search"
                value="{{ request()->query('search') }}">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </x-slot>
    <!-- Swiper -->
    <div class="swiper-container mySwiper">
        <h3 class="pb-4 mb-4 mt-2 fst-italic border-bottom display-6 text-center">Featured Books</h3>
        <div class="swiper-wrapper">
            @foreach ($featureds as $featured)
                <div class="swiper-slide">
                    <div class="col-md-6">
                        <div
                            class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                            <div class="col p-4 d-flex flex-column position-static">
                                <strong class="d-inline-block mb-2 text-primary">{{ $featured->title }}</strong>
                                <h3 class="mb-0">Featured Book</h3>
                                <div class="mb-1 text-muted">{{ $featured->auhtor }}</div>
                                <p class="card-text mb-auto">{{ $featured->description }}</p>
                                <a href="books/show/{{ $featured->id }}" class="stretched-link">See book</a>
                            </div>
                            <div class="col-auto d-none d-lg-block">
                                <img src="{{ $featured->image }}" alt="{{ $featured->title }}" width="200"
                                    height="250">
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <div class="container">
        <h2 class="pb-4 mb-4 mt-2 fst-italic border-bottom display-6">Book Catalog</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-4">
            @forelse ($books as $book)
                <div class="col d-flex align-items-stretch">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <a href="{{ route('books.show', $book->id) }}">
                                    <img src="{{ $book->image }}" alt="{{ $book->title }}">
                                </a>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $book->title }}</h5>
                                    <p class="card-text"><small class="text-muted">
                                            by {{ $book->author }}
                                        </small></p>
                                    <p class="card-text">{{ $book->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">
                    No results found for query <strong>{{ request()->query('search') }}</strong>
                </p>
            @endforelse
        </div>
        {{-- {{ $books->links() }} --}}
        {{ $books->appends(['search' => request()->query('search')])->links() }}

    </div>


    @section('scripts')
        <!-- Swiper JS -->
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <!-- Initialize Swiper -->
        <script>
            var swiper = new Swiper(".mySwiper", {
                autoplay: {
                    delay: 5000,
                },
                coverflowEffect: {
                    rotate: 30,
                    slideShadows: false,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });

        </script>
    @endsection
</x-app-layout>
