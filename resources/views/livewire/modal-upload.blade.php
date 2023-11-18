<div>
 
    <div class="modal fade @if($show === true) show @endif " id="myExampleModal" style="display: @if($show === true)
                 block
         @else
                 none
         @endif;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content rounded-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload laporan {{ ucwords($periode) }}</h5>
                    <button class="close" type="button" aria-label="Close" wire:click.prevent="closeModal()">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{-- <button type="button" class="btn-close" aria-label="Close"
                        wire:click.prevent="closeModal()"></button> --}}
                </div>
 
                <div class="modal-body">
                   <form action="{{ url('report/upload_'.$periode) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="">File</label>
                        <input type="file" name="file" id="" class="form-control">
                    </div>
                    <button class=" btn btn-primary" type="submit">Simpan</button>
                    <button class=" btn btn-secondary" type="button" wire:click.prevent="closeModal()">Tutup</button>
                    <input type="hidden" name="report_id" value="{{ $report_id }}">
                   
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

