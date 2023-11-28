<div>
 
    <div class="modal fade @if($show === true) show @endif " id="myExampleModal" style="display: @if($show === true)
                 block
         @else
                 none
         @endif;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content rounded-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Download Laporan</h5>
                    <button class="close" type="button" aria-label="Close" wire:click.prevent="closeModal()">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{-- <button type="button" class="btn-close" aria-label="Close"
                        wire:click.prevent="closeModal()"></button> --}}
                </div>
 
                <div class="modal-body">
                   <form action="{{ url('/download_monev_'.$periode) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                   
                    <div x-data="{jenis:''}">

                      <div class="form-group">
                          <label for="">Jenis Laporan</label>
                        <select name="jenis_laporan" id="" class="form-control"   x-model="jenis">
                          <option value="" selected disabled>Pilih</option>
                         <option value="monev">Monev</option>
                         <option value="tl">TL</option>
                        </select>
                      </div>
                      <div class="form-group" x-show="jenis=='tl'">
                        <label for="">Tanggal TL</label>
                        <input type="date" name="tanggal_tl" id="" class="form-control">
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="">PIC</label>
                      <select name="pic" id="" class="form-control">
                        <option value="" selected disabled>Pilih</option>
                        @foreach ($pejabats as $pejabat)
                            
                        <option value="{{ $pejabat->id }}">{{ $pejabat->nama }}</option>
                        @endforeach
                       
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="">Mengetahui</label>
                      <select name="mengetahui" id="" class="form-control">
                        <option value="" selected disabled>Pilih</option>
                        @foreach ($pejabats as $pejabat)
                            
                        <option value="{{ $pejabat->id }}">{{ $pejabat->nama }}</option>
                        @endforeach
                       
                      </select>
                    </div>
                    <input type="hidden" name="id" value="{{ $id }}">
                 
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

