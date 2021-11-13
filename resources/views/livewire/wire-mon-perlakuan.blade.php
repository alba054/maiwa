 <div class="row">
     <div class="col-12 mb-4">

         <button wire:click="create" class="btn btn-primary"><i class="fe fe-plus"></i>
             Tambahkan Perlakuan</button>
         <button wire:click="openSearchModal" class="btn btn-primary"><i class="fe fe-search"></i>
             Filter Pencarian</button>

     </div>

     <div class="col-xl-12 col-lg-12">
         <div class="card">
             <div class="card-header">

                 <div class="col">
                     <div class="card-title">Tabel Perlakuan</div>
                 </div>

             </div>
             <div class="card-body">

                 <div class="table-responsive">
                     <table class="table table-hover card-table table-vcenter text-nowrap">

                         @if (count($perlakuans) != 0)
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Sapi</th>
                                     <th>Tgl Perlakuan</th>
                                     <th>Jenis Obat</th>
                                     <th>Dosis Obat</th>
                                     <th>Vaksin</th>
                                     <th>Dosis Vaksin</th>
                                     <th>Vitamin</th>
                                     <th>Dosis Vitamin</th>
                                     <th>Hormon</th>
                                     <th>Dosis Hormon</th>
                                     <th>Ket Perlakuan</th>

                                     <th>Peternak</th>
                                     <th>Pendamping</th>
                                     <th>TSR</th>

                                     <th class="text-right">Aksi</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($perlakuans as $item)
                                     <tr>
                                         <td>{{ $loop->iteration }}</td>
                                         <td>{{ $item->sapi->eartag }}</td>
                                         <td>{{ $item->tgl_perlakuan }}</td>
                                         <td>{{ $item->obat->name }}</td>
                                         <td>{{ $item->dosis_obat }}</td>
                                         <td>{{ $item->vaksin->name }}</td>
                                         <td>{{ $item->dosis_vaksin }}</td>
                                         <td>{{ $item->vitamin->name }}</td>
                                         <td>{{ $item->dosis_vitamin }}</td>
                                         <td>{{ $item->hormon->name }}</td>
                                         <td>{{ $item->dosis_hormon }}</td>
                                         <td>{{ $item->ket_perlakuan }}</td>
                                         <td>{{ $item->peternak->nama_peternak }}</td>
                                         <td>{{ $item->pendamping->user->name }}
                                         </td>
                                         <td>{{ $item->tsr->user->name }}</td>

                                         <td class="text-right">
                                             <i wire:click="selectedItem({{ $item->id }},'export')"
                                                 class="fe fe-list f-16 btn btn-warning" style="cursor:pointer"></i>
                                             <i wire:click="selectedItem({{ $item->id }},'update')"
                                                 class="fe fe-edit f-16 btn btn-success" style="cursor:pointer"></i>
                                             <i wire:click="selectedItem({{ $item->id }},'delete')"
                                                 class="fe fe-trash-2 f-16 btn btn-danger" style="cursor:pointer"></i>
                                         </td>
                                     </tr>
                                 @endforeach
                             </tbody>

                         @else
                             There no Data Yet
                         @endif



                     </table>
                 </div>

                 <div class="dimmer active" style="height: 5px; margin-top: 0;" wire:loading>
                     <div class="spinner4">
                         <div class="bounce1"></div>
                         <div class="bounce2"></div>
                         <div class="bounce3"></div>
                     </div>
                 </div>
             </div>

         </div>
     </div>

     <!-- User Form Modal -->
     <div class="modal fade" role="dialog" tabindex="-1" id="search-form-modal">
         <div class="modal-dialog" role="document">
             @livewire('perlakuan.wire-form-perlakuan-search')

         </div>
     </div>

     <!-- User Form Modal -->
     <div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal">
         <div class="modal-dialog" role="document">
             @livewire('wire-mon-perlakuan-form')

         </div>
     </div>
 </div>
