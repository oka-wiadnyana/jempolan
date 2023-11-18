<x-layout.main>
    <x-slot:title>
        {{ $title.' '.ucwords($bagian) }}
    </x-slot>
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn waves-effect waves-light btn-primary" onclick="showModalTambahLaporanTriwulan('{{ $level_id }}'); return false">Tambah laporan</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Laporan</th>
                                    <th>Tanggal laporan</th>
                                   
                                    <th>Triwulan</th>
                                    <th>Tahun</th>
                                    <th>File</th>
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
    <livewire:modal-upload />
    <livewire:modal-add-laporan-triwulan />
    <livewire:modal-edit-laporan-triwulan />
    
    @push('foot')
        <script>
            $(function() {

                var table = $('#table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ url('get_laporan_triwulan/'.$level_id) }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'report_name',
                            name: 'report_name'
                        },
                        {
                            data: 'tanggal_laporan',
                            name: 'tanggal_laporan'
                        },
                      
                        {
                            data: 'quarter',
                            name: 'quarter'
                        },
                        {
                            data: 'year',
                            name: 'year'
                        },
                        {
                            data: 'file_download',
                            name: 'file_download'
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

            function showModalTambahLaporanTriwulan(unit){
                console.log(unit);
                Livewire.dispatch('show-modal-tambah-laporan-triwulan',{'unit':unit});
            }
            function showModalEdit(id){
                Livewire.dispatch('show-modal-edit-laporan-triwulan',{'id':id});
            }
            
            function showModalUpload(id,periode){
                Livewire.dispatch('show-modal-upload',{'id':id,'periode':periode});
            }

            function deleteLaporan(id){
                Swal.fire({
                    title: "Yakin dihapus?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Yakin",
                    denyButtonText: `Tidak`
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        axios.post('{{ url("/report/delete_laporan_triwulan") }}', {
                            id: id,
                          
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
