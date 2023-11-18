<div>
 
    <div class="modal fade @if($show === true) show @endif " id="myExampleModal" style="display: @if($show === true)
                 block
         @else
                 none
         @endif;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content rounded-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah laporan Triwulan</h5>
                    <button class="close" type="button" aria-label="Close" wire:click.prevent="closeModal()">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{-- <button type="button" class="btn-close" aria-label="Close"
                        wire:click.prevent="closeModal()"></button> --}}
                </div>
 
                <div class="modal-body">
                   <form action="{{ url('report/insert_laporan_triwulan') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Laporan</label>
                        <select name="report_name" id="" class="form-control">
                            <option value="" selected disabled>Pilih</option>
                            @foreach ($report_refs as $report_ref)
                            <option value="{{ $report_ref->report_name }}"  >{{ $report_ref->report_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tgl Laporan</label>
                       <input type="date" name="report_date" id="" class="form-control">
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="">Triwulan</label>
                        <select name="quarter" id="" class="form-control">
                            <option value="" selected disabled>Pilih</option>
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tahun</label>
                        <select name="year" id="" class="form-control">
                            <option value="" selected disabled>Pilih</option>
                            @foreach ($years as $year)
                          
                            <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <label for="">File</label>
                        <input type="file" name="file" id="" class="form-control">
                    </div> --}}
                    <button class=" btn btn-primary" type="submit">Simpan</button>
                    <button class=" btn btn-secondary" type="button" wire:click.prevent="closeModal()">Tutup</button>
                    <input type="hidden" name="level_id" value="{{ $level_id }}">
                    <input type="hidden" name="periode_id" value="{{ $periode_id }}">
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

