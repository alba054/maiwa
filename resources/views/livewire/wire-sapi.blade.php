 <div class="row">
     <div class="col-12 mb-4">
         <button wire:click="create" class="btn btn-outline-primary"><i class="fe fe-plus"></i>
             Tambahkan Sapi</button>
         <button wire:click="openSearchModal" class="btn btn-outline-primary"><i class="fe fe-search"></i>
             Filter Pencarian</button>
         <button wire:click="exportToExcel" class="btn btn-outline-success"><i class="fe fe-printer"></i>
             Export to Excel</button>
     </div>
     <div class="col-xl-12 col-lg-12">
         <div class="card">
             <div class="card-header">

                 <div class="card-title">Tabel Sapi</div>
                 <div class="card-options">
                     <select class="custom-select" wire:model="rows">
                         <option value="5">5 Rows</option>
                         <option value="10">10 Rows</option>
                         <option value="50">50 Rows</option>
                         <option value="100">100 Rows</option>
                         <option value="250">250 Rows</option>
                         <option value="500">500 Rows</option>


                     </select>
                 </div>


             </div>
             <div class="card-body">
                 <div class="row">
                     <div class="col-sm-4">

                     </div>
                     <div class="col-sm-4">

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
                                     <th>Foto Penampakan Sapi</th>
                                     <th>Eartag</th>
                                     <th>Nama Sapi</th>
                                     <th>Tgl Lahir</th>
                                     <th>Umur</th>
                                     <th>Kelamin</th>
                                     <th>Jenis Sapi</th>
                                     <th>Peternak</th>
                                     <th>Pendamping</th>

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

                                             <img src="{{ url('storage/photos_thumb', $item->foto_samping) }}"
                                                 alt="Image" style="height: 30px; width: 30px;">

                                             <img src="{{ url('storage/photos_thumb', $item->foto_peternak) }}"
                                                 alt="Image" style="height: 30px; width: 30px;">

                                             <img src="{{ url('storage/photos_thumb', $item->foto_rumah) }}"
                                                 alt="Image" style="height: 30px; width: 30px;">
                                         </td>
                                         <td>
                                             <a href="{{ route('sapi.show', $item->eartag) }}">

                                                 {{ 'MBC-' . $item->generasi . '.' . $item->anak_ke . '-' . $item->eartag_induk . '-' . $item->eartag }}
                                             </a>
                                         </td>
                                         <td>{{ $item->nama_sapi }}</td>
                                         <td>{{ $item->tanggal_lahir }}</td>
                                         <td>
                                             @php
                                                 date_default_timezone_set('Asia/Makassar');
                                                 $now = now()->format('Y/m/d');
                                                 $bday = Carbon\Carbon::parse($item->tanggal_lahir);
                                                 echo $bday->diffInYears($now) . ' Tahun, ' . $bday->diffInMonths($now) . ' Bulan, ' . $bday->diffInDays($now) . ' Hari';
                                             @endphp
                                         </td>
                                         <td>{{ $item->kelamin }}</td>
                                         <td>{{ $item->jenis_sapi->jenis }}</td>
                                         <td>{{ $item->peternak->nama_peternak }}</td>
                                         <td>{{ $item->peternak->pendamping->user->name }}</td>

                                         <td class="text-right">
                                             @if (strtolower($item->kelamin) == 'betina')
                                                 <i wire:click="selectedItem({{ $item->id }},'child')"
                                                     class="fe fe-git-merge f-16 btn btn-warning"
                                                     style="cursor:pointer"></i>
                                             @endif


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
                     {{ $datas->links() }}
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
             @livewire('wire-sapi-search')
         </div>
     </div>

     <!-- User Form Modal -->
     <div class="modal fall" role="dialog" tabindex="-1" id="user-form-modal">
         <div class="modal-dialog modal-lg" role="document">
             @livewire('wire-sapi-form')
         </div>
     </div>
 </div>
