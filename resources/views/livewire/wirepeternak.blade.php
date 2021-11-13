 <div>

     <div class="col-6 mb-4">
         <button wire:click="create" class="btn btn-outline-primary"><i class="fe fe-plus"></i>
             Tambahkan Peternak Baru</button>
         <button wire:click="openSearchModal" class="btn btn-outline-primary"><i class="fe fe-search"></i>
             Filter Pencarian</button>
     </div>

     <div class="col-xl-12 col-lg-12">
         <div class="card">
             <div class="card-header">
                 <div class="card-title col-xl-3">Tabel Peternak</div>

             </div>
             <div class="card-body">

                 <div class="row">
                     <div class="col-sm-4">
                         <div class="form-group">
                         </div>
                     </div>
                     <div class="col-sm-4">
                         {{-- <div class="form-group">
                             <select class="custom-select" wire:model="userId">
                                 <option value="">Silahkan pilih pendamping</option>
                                 @foreach ($users as $item)
                                     <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                 @endforeach
                             </select>
                         </div> --}}
                     </div>
                     <div class="col-sm-4">
                         <div class="form-group">
                             <input wire:model="searchTerm" type="search" class="form-control" placeholder="Search…"
                                 aria-label="Search">
                         </div>
                     </div>
                 </div>
                 <div class="table-responsive">
                     <table class="table table-hover card-table table-vcenter text-nowrap">

                         @if (count($peternaks) != 0)
                             <thead>
                                 <tr>
                                     {{-- <th>#</th> --}}
                                     <th>Kode</th>
                                     <th>Pendamping</th>
                                     <th>Nama Peternak</th>
                                     <th>Tgl Lahir</th>
                                     <th>Nomor HP</th>
                                     <th>Anggota</th>
                                     <th>Luas Lahan</th>
                                     <th>Kelompok</th>
                                     <th>Kabupaten</th>
                                     <th>Kecamatan</th>
                                     <th>Desa</th>
                                     <th class="text-right">Aksi</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($peternaks as $item)
                                     <tr>
                                         {{-- <td>{{ $loop->iteration }}</td> --}}
                                         <td>{{ $item->kode_peternak }}</td>
                                         <td>{{ $item->pendamping->user->name }}</td>
                                         <td>{{ $item->nama_peternak }}</td>
                                         <td>{{ $item->tgl_lahir }}</td>
                                         <td>{{ $item->no_hp }}</td>
                                         <td>{{ $item->jumlah_anggota }}</td>
                                         <td>{{ $item->luas_lahan }}</td>
                                         <td>{{ $item->kelompok->name }}</td>
                                         <td>{{ $item->desa->kecamatan->kabupaten->name }}</td>
                                         <td>{{ $item->desa->kecamatan->name }}</td>
                                         <td>{{ $item->desa->name }}</td>

                                         <td class="text-right">
                                             <i wire:click="selectemItem({{ $item->id }},'update')"
                                                 class="fe fe-edit f-16 btn btn-outline-success"
                                                 style="cursor:pointer"></i>
                                             <i wire:click="selectemItem({{ $item->id }},'delete')"
                                                 class="fe fe-trash-2 f-16 btn btn-outline-danger"
                                                 style="cursor:pointer"></i>
                                         </td>
                                     </tr>
                                 @endforeach
                             </tbody>

                         @else
                             There no Data Yet
                         @endif



                     </table>

                     {{ $peternaks->links() }}
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
             @livewire('wirepeternaksearch')
         </div>
     </div>

     <!-- User Form Modal -->
     <div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal">
         <div class="modal-dialog" role="document">
             @livewire('wirepeternakform')

         </div>
     </div>
 </div>
