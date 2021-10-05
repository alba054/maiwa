 <div class="row">
     <div class="col-6 mb-4">
         <button wire:click="create" class="btn btn-primary"><i class="fe fe-plus"></i>
             Tambahkan Sapi</button>
     </div>
     <div class="col-xl-12 col-lg-12">
         <div class="card">
             <div class="card-header">
                 <div class="col">
                     <div class="card-title">Tabel Sapi</div>
                 </div>

             </div>
             <div class="card-body">
                 <div class="row">
                     <div class="col-sm-4">

                     </div>
                     <div class="col-sm-4">
                         <div class="form-group">
                             <select class="custom-select" wire:model="peternak_id">
                                 <option value="">Please Choose</option>
                                 @foreach ($peternaks as $item)
                                     <option value="{{ $item->id }}"> {{ $item->nama_peternak }} </option>
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
                     <table class="table table-responsive table-hover text-nowrap">

                         @if (count($datas) != 0)
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Foto Sapi</th>
                                     <th>Jenis Sapi</th>
                                     <th>Ertag</th>
                                     <th>Ertag Induk</th>
                                     <th>Nama Sapi</th>
                                     <th>Tgl Lahir</th>
                                     <th>Kelamin</th>
                                     <th>Kondisi Lahir</th>
                                     <th>Anak Ke</th>
                                     <th>Peternak</th>
                                     <th class="text-right">Aksi</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($datas as $item)
                                     <tr>
                                         <td>{{ $loop->iteration }}</td>
                                         <td>
                                             <img src="{{ url('storage/photos_thumb/' . $item->foto_depan) }}"
                                                 alt="Image" style="height: 30px; width: 30px;">

                                             <img src="{{ url('storage/photos_thumb', $item->foto_belakang) }}"
                                                 alt="Image" style="height: 30px; width: 30px;"><br />

                                             <img src="{{ url('storage/photos_thumb', $item->foto_kanan) }}"
                                                 alt="Image" style="height: 30px; width: 30px;">

                                             <img src="{{ url('storage/photos_thumb', $item->foto_kiri) }}"
                                                 alt="Image" style="height: 30px; width: 30px;">
                                         </td>
                                         <td>{{ $item->jenis_sapi->jenis }}</td>
                                         <td>{{ $item->ertag }}</td>
                                         <td>{{ $item->ertag_induk }}</td>
                                         <td>{{ $item->nama_sapi }}</td>
                                         <td>{{ $item->tanggal_lahir }}</td>
                                         <td>{{ $item->kelamin }}</td>
                                         <td>{{ $item->kondisi_lahir }}</td>
                                         <td>{{ $item->anak_ke }}</td>
                                         <td>{{ $item->peternak->nama_peternak }}</td>
                                         <td class="text-right">
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
             </div>

         </div>
     </div>

     <!-- User Form Modal -->
     <div class="modal fall" role="dialog" tabindex="-1" id="user-form-modal">
         <div class="modal-dialog modal-lg" role="document">
             @livewire('wire-sapi-form')
         </div>
     </div>
 </div>
