<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rents Index') }}
            <div class="float-right">
                <x-nav-link :href="route('rents.create')" :active="request()->routeIs('rents.create')">
                    <x-button>Add Rent</x-button>
                </x-nav-link>
            </div>
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Rent List
                </div>
                <div id="rent-table"></div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            function paramLookup(cell) {
                //get edit page
                return {
                    url: "rents/" + cell.getValue() + "/edit",
                    label: "edit",
                };
            }
            var tabledata = {!! $rents !!};
            var table = new Tabulator("#rent-table", {
                data: tabledata,
                height: "100%",
                layout: "fitColumns",
                pagination: "local",
                paginationSize: 10,
                columns: [{
                        formatter: "rownum",
                        hozAlign: "center",
                        width: 40
                    },
                    {
                        title: "Book",
                        field: "book.title",
                        sorter: "number"
                    },
                    {
                        title: "User",
                        field: "user.name",
                        sorter: "number"
                    },
                    {
                        title: "Rent Date",
                        field: "rent_at",
                        sorter: "date"

                    },
                    {
                        title: "Return Date",
                        field: "return_at",
                        sorter: "date"
                    },
                    {
                        title: "Status",
                        field: "status",
                        formatter: "tickCross",
                        sorter: "boolean",
                        hozAlign: "center",
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
                                    url: '/rents/' + cell.getValue(),
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
