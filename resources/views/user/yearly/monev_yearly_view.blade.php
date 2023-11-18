<x-layout.main>
    <x-slot:title>
        {{ $title.' '.ucwords($bagian) }}
    </x-slot>
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('/insert_monev_tahunan') }}" method="post">
                        @csrf
                        <div class="table-responsive">
                            <table class="table" >
                                <thead>
                                    <tr>
                                        <th>Object</th>
                                        <th>Kesesuian</th>
                                        <th>Ketidaksesuaian</th>
                                      
                                        <th>Tnd. Perbaikan</th>
                                        <th>Pen. Jawab</th>
                                        <th>Close date</th>
                                    </tr>
                                </thead>
                                <tbody x-data="{disabled:true}" @set-show.window="disabled=$event.detail.disabled" >
                                    @if($mode=='edit')
                                    @foreach ($monevs as $monev)
                                    <tr>
                                        <td>
                                            <textarea x-bind:disabled="disabled"
                                            class="form-control" name="object_name[]" id="" cols="30" rows="5">{{ $monev->object_name }}</textarea>
                                        </td>
                                        <td>
                                            <textarea x-bind:disabled="disabled" class="form-control" name="kesesuaian[]" id="" cols="30" rows="5">{{ $monev->kesesuaian }}</textarea>
                                        </td>
                                        <td>
                                            <textarea x-bind:disabled="disabled" class="form-control" name="ketidaksesuaian[]" id="" cols="30" rows="5">{{ $monev->ketidaksesuaian }}</textarea>
                                        </td>
                                        
                                        <td>
                                            <textarea x-bind:disabled="disabled" class="form-control" name="tindakan_perbaikan[]" id="" cols="30" rows="5">{{ $monev->tindakan_perbaikan }}</textarea>
                                        </td>
                                        <td>
                                            <textarea x-bind:disabled="disabled" class="form-control" name="penanggung_jawab[]" id="" cols="30" rows="5">{{ $monev->penanggung_jawab }}</textarea>
                                        </td>
                                        <td>
                                        <input x-bind:disabled="disabled" type="date" name="close_date[]" id="" class="form-control" value="{{ $monev->close_date }}">
                                        </td>
                                    </tr>
                                    <input type="hidden" name="monev_id[]" value="{{ $monev->id }}">
                                    
                                    @endforeach
                                    @else
                                    @foreach ($objects as $object)
                                    <tr>
                                        <td>
                                            <textarea class="form-control" name="object_name[]" id="" cols="30" rows="5">{{ $object->object_name }}</textarea>
                                        </td>
                                        <td>
                                            <textarea class="form-control" name="kesesuaian[]" id="" cols="30" rows="5"></textarea>
                                        </td>
                                        <td>
                                            <textarea class="form-control" name="ketidaksesuaian[]" id="" cols="30" rows="5"></textarea>
                                        </td>
                                       
                                        <td>
                                            <textarea class="form-control" name="tindakan_perbaikan[]" id="" cols="30" rows="5"></textarea>
                                        </td>
                                        <td>
                                            <textarea class="form-control" name="penanggung_jawab[]" id="" cols="30" rows="5"></textarea>
                                        </td>
                                        <td>
                                        <input type="date" name="close_date[]" id="" class="form-control">
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            
                            </table>
                        </div>
                        <input type="hidden" name="report_id" value="{{ $report_id }}">
                        <input type="hidden" name="mode" value="{{ $mode }}">
                        <input type="hidden" name="level_name" value="{{ $level_name }}">
                        {{-- <div x-data="{show_submit:{{ $mode==''?true:false }} }">

                            <button type="submit" class="btn btn-primary" x-show="show_submit" >Submit</button>
                            
                           
                        </div> --}}
                        <div class="row">
                            <div x-data="{show_submit:{{ $mode!='edit'?'true':'false' }} }" class="col-1 mr-2">

                                <button type="submit" class="btn btn-primary" x-show="show_submit" @set-show.window="show_submit=$event.detail.submit_cancel">Submit</button>
                               
                            </div>
                            <div x-data="{show_submit:{{ $mode!='edit'?'true':'false' }} }" class="col-1">
    
                              
                                <a x-show="show_submit"  href="{{ url('report/tahunan/'.$level_name) }}" class="btn btn-secondary" >Kembali</a>
                               
                            </div>
                                                   
                            <div x-data="{show_cancel:false}" class="col-1 mr-2">
    
                                <button type="" class="btn btn-warning" x-show="show_cancel" @set-show.window="show_cancel=$event.detail.submit_cancel" @click.prevent="$dispatch('set-show',{ submit_cancel: false,edit:true,disabled:true })">Cancel</button>
                                <div class="col"></div>
                              
                               
                            </div>
                            <div x-data="{show_cancel:false}" class="col-1">
    
                              
                                <a x-show="show_cancel"  href="{{ url('report/tahunan/'.$level_name) }}" class="btn btn-secondary" @set-show.window="show_cancel=$event.detail.submit_cancel">Kembali</a>
                               
                            </div>
                         
                        </div>
                      <div class="row">

                            <div class="col" x-data="{show_edit:{{ $mode=='edit'?'true':'false' }} }" >

                                <button type="" class="btn btn-warning" x-show="show_edit" @click.prevent="$dispatch('set-show',{ submit_cancel: true,edit:false,disabled:false })"
                            
                                
                                @set-show.window="show_edit=$event.detail.edit">Edit</button>                                
                                <a href="{{ url('report/tahunan/'.$level_name) }}" class="btn btn-secondary" x-show="show_edit"  @set-show.window="show_edit=$event.detail.edit">Kembali</a>
    
                               
                            
                            </div>
                            
                        </div>

                    </form>
                
                </div>
            </div>

        </div>

    </div>
    {{-- {{-- <livewire:modal-add-report /> --}}
    {{-- <livewire:modal-add-laporan-tahunan />
    <livewire:modal-edit-laporan-tahunan />
    <livewire:modal-detail-laporan-tahunan /> --}}
    @push('foot')
        <script>
            
            function showModalTambahLaporanTahunan(unit){
                console.log(unit);
                Livewire.dispatch('show-modal-tambah-laporan-tahunan',{'unit':unit});
            }
            function showModalEdit(id){
                Livewire.dispatch('show-modal-edit-laporan-tahunan',{'id':id});
            }
            function showModalDetail(id){
                Livewire.dispatch('show-modal-detail-laporan-tahunan',{'id':id});
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
                        axios.post('{{ url("/report/delete_laporan_tahunan") }}', {
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
