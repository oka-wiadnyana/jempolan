<div>
 
    <div class="modal fade @if($show === true) show @endif " id="myExampleModal" style="display: @if($show === true)
                 block
         @else
                 none
         @endif;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content rounded-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah laporan Bulanan</h5>
                    <button class="close" type="button" aria-label="Close" wire:click.prevent="closeModal()">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{-- <button type="button" class="btn-close" aria-label="Close"
                        wire:click.prevent="closeModal()"></button> --}}
                </div>
 
                <div class="modal-body">
                   <form action="{{ url('report/insert_laporan_bulanan') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Laporan</label>
                        <select name="report_id" id="" class="form-control">
                            <option value="" selected disabled>Pilih</option>
                            @foreach ($report_refs as $report_ref)
                            <option value="{{ $report_ref->id }}"  >{{ $report_ref->report_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tgl Laporan</label>
                       <input type="date" name="report_date" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Obj. Monitoring</label>
                       <textarea name="objek_monitoring" id="" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                 
                    <div class="form-group">
                        <label for="">Hasil Evaluasi</label>
                       <textarea name="hasil_evaluasi" id="" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Rekomendasi</label>
                       <textarea name="rekomendasi" id="" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Tindak Lanjut</label>
                       <textarea name="tindak_lanjut" id="" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Bulan</label>
                        <select name="month" id="" class="form-control">
                            <option value="" selected disabled>Pilih</option>
                            @foreach ($months as $month)
                          
                            <option value="{{ $month['month_number'] }}">{{ $month['month_name'] }}</option>
                            @endforeach
                            
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
                    <div class="form-group">
                        <label for="">File</label>
                        <input type="file" name="file" id="" class="form-control">
                    </div>
                    <button class=" btn btn-primary" type="submit">Simpan</button>
                    <button class=" btn btn-secondary" type="button" wire:click.prevent="closeModal()">Tutup</button>
                    <input type="hidden" name="level_id" value="{{ $unit }}">
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

