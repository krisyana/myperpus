<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Index') }}
            <div class="float-right">
                <x-nav-link :href="route('categories.create')" :active="request()->routeIs('categories.create')">
                    <x-button>Add Category</x-button>
                </x-nav-link>
            </div>
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Category List
                </div>
                <div id="category-table"></div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            function paramLookup(cell) {
                //get edit page
                return {
                    url: "categories/" + cell.getValue() + "/edit",
                    label: "edit",
                };
            }
            var tabledata = {!! $categories !!};
            var table = new Tabulator("#category-table", {
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
                        title: "Name",
                        field: "name",
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
                                    url: '/categories/' + cell.getValue(),
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
