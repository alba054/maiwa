 <div class="row">
     <div class="col-xl-3 col-lg-4">
         <div class="card">
             <div class="card-header">
                 <div class="card-title">Tambah Jenis Sapi</div>
             </div>
             <div class="card-body">
                 <div class="text-center mb-5">
                     <div class="widget-user-image">
                         <img alt="User Avatar" class="rounded-circle  mr-3"
                             src="{{ URL::asset('assets/images/users/2.jpg') }}">
                     </div>
                 </div>
                 <div class="form-group">
                     <label class="form-label">Jenis Sapi</label>
                     <input wire:model="jenis" type="text" class="form-control" placeholder="e.g: Asep Sunarya">
                     @error('jenis')
                         <small class="mt-2 text-danger">{{ $message }}</small>
                     @enderror
                 </div>
                 <div class="form-group">
                     <label class="form-label">Keterangan Jenis</label>
                     <input wire:model="ket_jenis" type="text" class="form-control" placeholder="e.g: Sapi Perah">
                     @error('ket_jenis')
                         <small class="mt-2 text-danger">{{ $message }}</small>
                     @enderror
                 </div>
             </div>
             <div class="card-footer text-right">
                 <button wire:click="save" class="btn btn-primary">Submit</button>
             </div>
         </div>
     </div>
     <div class="col-xl-9 col-lg-8">
         <div class="card">
             <div class="card-header">
                 <div class="col">
                     <div class="card-title">Tabel Pengguna</div>
                 </div>

             </div>
             <div class="card-body">
                 <div class="row">
                     <div class="col-sm-6">

                     </div>
                     <div class="col-sm-6">
                         <div class="form-group">
                             <input wire:model="searchTerm" type="search" class="form-control" placeholder="Search…"
                                 aria-label="Search">
                         </div>
                     </div>
                 </div>
                 <div class="table-responsive">
                     <table class="table table-hover card-table table-vcenter text-nowrap">

                         @if (count($datas) != 0)
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Jenis Sapi</th>
                                     <th>Keterangan</th>
                                     <th class="text-right">Aksi</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($datas as $item)
                                     <tr>
                                         <th>{{ $loop->iteration }}</th>
                                         <td>{{ $item->jenis }}</td>
                                         <td>{{ $item->ket_jenis }}</td>
                                         </td>
                                         <td class="text-right">
                                             <i wire:click="selectemItem({{ $item->id }},'update')"
                                                 class="fe fe-edit f-16 btn btn-success" style="cursor:
                             pointer"></i>
                                             <i wire:click="selectemItem({{ $item->id }},'delete')"
                                                 class="fe fe-trash-2 f-16 btn btn-danger" style="cursor:
                             pointer"></i>
                                         </td>
                                     </tr>
                             </tbody>
                         @endforeach
                     @else
                         There no Data Yet
                         @endif
                     </table>
                 </div>
             </div>

         </div>
     </div>
 </div>
