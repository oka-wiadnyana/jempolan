<div>
 
    <div class="modal fade @if($show === true) show @endif " id="myExampleModal" style="display: @if($show === true)
                 block
         @else
                 none
         @endif;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content rounded-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah laporan</h5>
                    <button class="close" type="button" aria-label="Close" wire:click.prevent="closeModal()">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{-- <button type="button" class="btn-close" aria-label="Close"
                        wire:click.prevent="closeModal()"></button> --}}
                </div>
 
                <div class="modal-body">
                   <form action="{{ url('ref/edit_laporan') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Laporan</label>
                        <input type="text" name="report_name" id="" class="form-control" value="{{ $report?->report_name }}">
                    </div>
                    <div class="form-group">
                        <label for="">Periode</label>
                        <select name="periode" id="" class="form-control">
                            <option value="" selected disabled>Pilih</option>
                            @foreach ($periodes as $periode)
                            <option value="{{ $periode->id }}" @selected($report?->periode==$periode->id)>{{ $periode->periode_name }}</option>
                            @endforeach
                          
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Bagian</label>
                        <select name="level_id" id="" class="form-control" @disabled($report?->level_id==auth()->user()->level->id) >
                            <option value="" selected disabled>Pilih</option>
                            @foreach ($levels as $level)
                            @if ($level->level_name=='super_admin')
                                @php
                                   continue;    
                                @endphp
                            @endif
                            <option value="{{ $level->id }}" @selected($report?->level_id==$level->id) >{{ $level->level_name }}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    <input type="hidden" name="id" value="{{ $report?->id }}">
                    <button class=" btn btn-primary" type="submit">Simpan</button>
                    <button class=" btn btn-secondary" type="button" wire:click.prevent="closeModal()">Tutup</button>
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
