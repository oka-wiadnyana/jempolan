<x-layout.main>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn waves-effect waves-light btn-primary" onclick="showModalTambahObject('{{ $periode }}','{{ $levelName }}'); return false">Tambah Object</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Object</th>
                                    <th>Ref Laporan</th>
                                    <th>Periode</th>
                                    <th>Level</th>

                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <livewire:modal-add-object />
    <livewire:modal-edit-object />
    @push('foot')
        <script>
            $(function() {

                var table = $('#table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ url('ref/get_object_monev/'.$periode.'/'.$levelName) }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'object_name',
                            name: 'object_name'
                        },
                        {
                            data: 'report_name',
                            name: 'report_name'
                        },
                        {
                            data: 'periode_name',
                            name: 'periode_name'
                        },
                        {
                            data: 'level_name',
                            name: 'level_name'
                        },

                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ]
                });

            });

            function showModalTambahObject(periode,levelName){
                Livewire.dispatch('show-modal-tambah-object',{
                    periode, levelName
                });
            }
            function showModalEdit(id,periode){
                Livewire.dispatch('show-modal-edit-object',{id,periode});
            }

            function deleteLaporan(id,periode){
                Swal.fire({
                    title: "Yakin dihapus?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Yakin",
                    denyButtonText: `Tidak`
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        axios.post('{{ url("/ref/delete_object") }}', {
                            id,
                            periode,
                          
                        })
                        .then(function (response) {
                           location.reload();
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    } else if (result.isDenied) {
                        Swal.fire("Cancel", "", "info");
                    }
                });
            }
        </script>
    @endpush

</x-layout.main>
