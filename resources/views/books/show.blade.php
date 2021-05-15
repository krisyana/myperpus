<x-app-layout>
    <x-slot name="header">
        <form class="d-flex mb-4" action=" {{ route('library.index') }} " method="GET">
            <input class="form-control me-2" type="search" placeholder="Search Book" aria-label="Search" name="search"
                value="{{ request()->query('search') }}">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </x-slot>

    <div class="container mt-4">
        <div class="card mb-3 border-dark">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ $book->image }}" alt="{{ $book->title }}">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Title</div>
                                    {{ $book->title }}
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Author</div>
                                    {{ $book->author }}
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Publisher</div>
                                    {{ $book->publisher }}
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Description</div>
                                    {{ $book->description }}
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Category</div>
                                    @foreach ($book->categories as $category)
                                        <a class="badge rounded-pill bg-secondary"
                                            href="{{ route('library.category', $category->id) }}">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Sum</div>
                                    {{ $book->sum }}
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
