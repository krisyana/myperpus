<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users Index') }}
            <div class="float-right">
                <x-nav-link :href="route('users.create')" :active="request()->routeIs('users.create')">
                    <x-button>Add User</x-button>
                </x-nav-link>
            </div>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    User List
                </div>
                <div id="user-table"></div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            function paramLookup(cell) {
                //get edit page
                return {
                    url: "users/" + cell.getValue() + "/edit",
                    label: "edit",
                };
            }
            var tabledata = {!! $users !!};
            var table = new Tabulator("#user-table", {
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
                        width: 200
                    },
                    {
                        title: "Email",
                        field: "email",
                        sorter: "number"
                    },
                    {
                        title: "Kelas",
                        field: "kelas",
                    },
                    {
                        title: "Jurusan",
                        field: "jurusan",
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
                                    url: '/users/' + cell.getValue(),
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
