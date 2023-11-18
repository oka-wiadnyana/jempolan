<div>
 
    <div class="modal fade @if($show === true) show @endif " id="myExampleModal" style="display: @if($show === true)
                 block
         @else
                 none
         @endif;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content rounded-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit laporan Semester</h5>
                    <button class="close" type="button" aria-label="Close" wire:click.prevent="closeModal()">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{-- <button type="button" class="btn-close" aria-label="Close"
                        wire:click.prevent="closeModal()"></button> --}}
                </div>
 
                <div class="modal-body">
                   <form action="{{ url('report/edit_laporan_semester') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        
                        <label for="">Nama Laporan</label>
                        <select name="report_name" id="" class="form-control">
                            <option value="" selected disabled>Pilih</option>
                            @foreach ($report_refs as $report_ref)
                            <option value="{{ $report_ref->report_name }}"  @selected($report_ref->report_name==$report_data?->report_name)>{{ $report_ref->report_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tgl Laporan</label>
                       <input type="date" name="report_date" id="" class="form-control" value="{{ $report_data?->report_date }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="">Semester</label>
                        <select name="semester" id="" class="form-control">
                            <option value="" selected disabled>Pilih</option>
                          
                          
                            <option value="I" @selected($report_data?->semester=="I")>I</option>
                            <option value="II" @selected($report_data?->semester=="II")>II</option>
                           
                           
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tahun</label>
                        <select name="year" id="" class="form-control">
                            <option value="" selected disabled>Pilih</option>
                            @foreach ($years as $year)
                          
                            <option value="{{ $year }}" @selected($year==$report_data?->year)>{{ $year }}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    
                   
                    <input type="hidden" name="id" value="{{ $report_data?->id }}">
                    <input type="hidden" name="level_id" value="{{ $report_data?->level_id }}">
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


