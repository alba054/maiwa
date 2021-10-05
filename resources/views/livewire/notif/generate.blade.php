 <div class="row">
     <div class="col-6 mb-4">
         <button wire:click="generate" class="btn btn-primary"><i class="fe fe-plus"></i>
             Generate Notifikasi</button>
     </div>
     <div class="col-xl-12 col-lg-12">
         <div class="card">
             <div class="card-header">
                 <div class="card-title">Tabel Notifikasi</div>
             </div>
             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-hover card-table table-vcenter text-nowrap">

                         @if (count($notifs) != 0)
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Sapi</th>
                                     <th>Tanggal</th>
                                     <th>Pesan Notifikasi</th>
                                     <th>Penerima</th>

                                 </tr>
                             </thead>
                             <tbody>

                                 @foreach ($notifs as $k => $item)


                                     <tr>
                                         <td>{{ $loop->iteration }}</td>
                                         <td>{{ $item->sapi->nama_sapi }}</td>
                                         <td>{{ $item->tanggal }}</td>
                                         <td>{{ $item->pesan }}</td>
                                         <td>{{ $item->sapi->peternak->user->name }}</td>
                                     </tr>


                                 @endforeach

                             </tbody>

                         @else
                             There no Data Yet
                         @endif



                     </table>
                 </div>
             </div>

         </div>
     </div>

     <!-- User Form Modal -->
     <div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal">
         <div class="modal-dialog" role="document">
             @livewire('wire-mon-perlakuan-form')

         </div>
     </div>
 </div>
