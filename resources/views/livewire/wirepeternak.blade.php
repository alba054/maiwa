 <div>

     <div class="col-6 mb-4">
         <button wire:click="create" class="btn btn-primary"><i class="fe fe-plus"></i>
             Tambahkan Peternak Baru</button>
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
                         <div class="form-group">
                             <select class="custom-select" wire:model="userId">
                                 <option value="">Silahkan pilih pendamping</option>
                                 @foreach ($users as $item)
                                     <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                 @endforeach
                             </select>
                         </div>
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
                                     <th>#</th>
                                     <th>Pendamping</th>
                                     <th>Kode</th>
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
                                         <td>{{ $loop->iteration }}</td>
                                         <td>{{ $item->user->name }}</td>
                                         <td>{{ $item->kode_peternak }}</td>
                                         <td>{{ $item->nama_peternak }}</td>
                                         <td>{{ $item->tgl_lahir }}</td>
                                         <td>{{ $item->no_hp }}</td>
                                         <td>{{ $item->jumlah_anggota }}</td>
                                         <td>{{ $item->luas_lahan }}</td>
                                         <td>{{ $item->kelompok }}</td>
                                         <td>{{ $item->desa->kecamatan->kabupaten->name }}</td>
                                         <td>{{ $item->desa->kecamatan->name }}</td>
                                         <td>{{ $item->desa->name }}</td>

                                         <td class="text-right">
                                             <i wire:click="selectemItem({{ $item->id }},'update')"
                                                 class="fe fe-edit f-16 btn btn-success" style="cursor:pointer"></i>
                                             <i wire:click="selectemItem({{ $item->id }},'delete')"
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
             </div>

         </div>
     </div>

     <!-- User Form Modal -->
     <div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal">
         <div class="modal-dialog" role="document">
             @livewire('wirepeternakform')

         </div>
     </div>
 </div>
