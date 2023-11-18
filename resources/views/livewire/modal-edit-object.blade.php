<div>
 
    <div class="modal fade @if($show === true) show @endif " id="myExampleModal" style="display: @if($show === true)
                 block
         @else
                 none
         @endif;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content rounded-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Object Monev {{ ucwords($periode) }}</h5>
                    <button class="close" type="button" aria-label="Close" wire:click.prevent="closeModal()">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{-- <button type="button" class="btn-close" aria-label="Close"
                        wire:click.prevent="closeModal()"></button> --}}
                </div>
 
                <div class="modal-body">
                   <form action="{{ url('ref/edit_object/'.$periode) }}" method="POST" >
                    @csrf
                        <div >
                            <div class="form-group">
                                <label for="">Unit</label>
                                <select name="periode" id="" class="form-control" disabled>
                                    <option value="" selected disabled>Pilih</option>
                                    @foreach ($levels as $level)
                                    @php 
                                    if($level->level_name=='super_admin'||$level->level_name=='admin'){
                                        continue;
                                    }
                                    @endphp
                                    <option value="{{ $level->id }}" @selected($level->id==$object_report?->reportName->level_id)>{{ ucwords($level->level_name) }}</option> 
                                    @endforeach
                                
                                </select>
                            </div>
                                
                            <div class="form-group">
                                <div>
                                    <label for="">Laporan</label>
                                    <select name="report_id" id="" class="form-control">
                                       
                                            @foreach ($all_reports as $report)
                                            <option value="{{ $report->id }}" @selected($report->id==$object_report->report_id)>{{ $report->report_name }}</option>
                                            @endforeach
                                      
                                       
                                    </select>
                                </div>
                                <div>
                                    <label for="">Object</label>
                                    <input type="text"  class="form-control" name="object_name" value="{{ $object_report?->object_name }}">
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $object_id }}">
                            <input type="hidden" name="periode" value="{{ $periode_id }}">
                            <button class=" btn btn-primary" type="submit">Simpan</button>
                            <button class=" btn btn-secondary" type="button" wire:click.prevent="closeModal()">Tutup</button>
                        </div>
                        
                   </form>
                   
 
                </div>
            </div>
        </div>
    </div>
    <!-- Let's also add the backdrop / overlay here -->
    <div class="modal-backdrop fade show" id="backdrop" style="display: @if($show === true)
                 block
         @else
                 none
         @endif;"></div>
 
</div>
