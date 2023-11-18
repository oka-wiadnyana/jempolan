<div>
 
    <div class="modal fade @if($show === true) show @endif " id="myExampleModal" style="display: @if($show === true)
                 block
         @else
                 none
         @endif;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content rounded-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pejabat</h5>
                    <button class="close" type="button" aria-label="Close" wire:click.prevent="closeModal()">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{-- <button type="button" class="btn-close" aria-label="Close"
                        wire:click.prevent="closeModal()"></button> --}}
                </div>
 
                <div class="modal-body">
                   <form action="{{ url('/insert_pejabat') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama</label>
                       <input type="text" name="nama" id="" class="form-control">
                    </div>
                   
                    <div class="form-group">
                        <label for="">Jabatan</label>
                      <select name="jabatan_id" id="" class="form-control">
                        <option value="" selected disabled>Pilih</option>
                        @foreach ($jabatans as $jabatan)
                            <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="">NIP</label>
                       <input type="text" name="nip" id="" class="form-control">
                    </div>
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

