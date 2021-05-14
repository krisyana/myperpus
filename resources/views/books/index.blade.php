<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books Index') }}
            <div class="float-right">
                <x-nav-link :href="route('books.create')" :active="request()->routeIs('books.create')">
                    <x-button>Add Book</x-button>
                </x-nav-link>
            </div>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Book List
                </div>
                <div id="book-table"></div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            function paramLookup(cell) {
                //get edit page
                return {
                    url: "books/" + cell.getValue() + "/edit",
                    label: "edit",
                };
            }
            var tabledata = {!! $books !!};
            var table = new Tabulator("#book-table", {
                data: tabledata,
                height: "100%",
                pagination: "local",
                paginationSize: 10,
                layout: "fitColumns",
                columns: [{
                        formatter: "rownum",
                        hozAlign: "center",
                        width: 40
                    },
                    {
                        title: "Title",
                        field: "title",
                        width: 200
                    },
                    {
                        title: "Author",
                        field: "author",
                        sorter: "number"
                    },
                    {
                        title: "Publisher",
                        field: "publisher",
                        widthGrow: 2
                    },
                    {
                        title: "Featured",
                        field: "featured",
                        formatter: "tickCross",
                        sorter: "boolean",
                        hozAlign: "center",
                    },
                    {
                        title: "Sum",
                        field: "sum",
                        hozAlign: "center"
                    },
                    {
                        title: "Description",
                        field: "description",
                        widthGrow: 3
                    },
                    {
                        title: "Edit",
                        field: "id",
                        width: 65,
                        hozAlign: "center",
                        formatter: "link",
                        formatterParams: paramLookup
                    },
                    {
                        title: "Delete",
                        field: "id",
                        hozAlign: "center",
                        formatter: "buttonCross",
                        width: 80,
                        cellClick: function(e, cell) {
                            $('#Modallayout').modal('show');
                            $("#modal-btn").click(function() {
                                $.ajax({
                                    url: '/books/' + cell.getValue(),
                                    type: 'delete',
                                    data: {
                                        _token: '{{ csrf_token() }}'
                                    },
                                    success: function(data) {
                                        $('#Modallayout').modal('hide');
                                    }

                                });
                                location.reload();
                            });
                        }
                    },
                ],
            });

        </script>

    @endsection
</x-app-layout>
