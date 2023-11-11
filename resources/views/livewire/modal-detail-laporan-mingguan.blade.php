<div>
 
    <div class="modal fade @if($show === true) show @endif " id="myExampleModal" style="display: @if($show === true)
                 block
         @else
                 none
         @endif;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content rounded-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail laporan Mingguan</h5>
                    <button class="close" type="button" aria-label="Close" wire:click.prevent="closeModal()">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{-- <button type="button" class="btn-close" aria-label="Close"
                        wire:click.prevent="closeModal()"></button> --}}
                </div>
 
                <div class="modal-body">
                   <form >
                
                    <div class="form-group">
                        <label for="">Nama Laporan</label>
                        <input type="text" class="form-control" id="" disabled value="{{ $report_data?->reportName?->report_name }}">
                       
                    </div>
                    <div class="form-group">
                        <label for="">Obj. Monitoring</label>
                        <textarea name="" id="" cols="30" rows="5" disabled class="form-control" >{{ $report_data?->objek_monitoring }}</textarea>
                       
                    </div>
                    <div class="form-group">
                        <label for="">Tgl Laporan</label>
                       <input type="date" name="report_date" id="" class="form-control" value="{{ $report_data?->report_date }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Hasil Evaluasi</label>
                        <textarea name="" id="" cols="30" rows="5" class="form-control" disabled>{{ $report_data?->hasil_evaluasi }}</textarea>
                       
                    </div>
                    <div class="form-group">
                        <label for="">Rekomendasi</label>
                        <textarea name="" id="" cols="30" rows="5" class="form-control" disabled>{{ $report_data?->rekomendasi }}</textarea>
                       
                    </div>
                    <div class="form-group">
                        <label for="">Tindak Lanjut</label>
                        <textarea name="" id="" cols="30" rows="5" class="form-control" disabled>{{ $report_data?->tindak_lanjut }}</textarea>
                       
                    </div>
                    <div class="form-group">
                        <label for="">Minggu</label>
                        <input type="text" name="report_date" id="" class="form-control" value="{{ $report_data?->week }}" disabled>
                      
                    </div>
                    <div class="form-group">
                        <label for="">Bulan</label>
                        <input type="text" name="report_date" id="" class="form-control" value="{{ $report_data?$months[$report_data->month]:"" }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Bulan</label>
                        <input type="text" name="report_date" id="" class="form-control" value="{{ $report_data?->year }}" disabled>
                    </div>
                   @if ($report_data?->file)
                   <div class="form-group">
                       
                        <a href="{{ asset('weekly_file/'.$report_data->file) }}" class="btn btn-success" target="_blank">Download</a>
                    </div>
                   @endif
                  
                    
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



