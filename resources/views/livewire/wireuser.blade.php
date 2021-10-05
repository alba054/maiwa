 <div class="row">
     <div class="col-xl-3 col-lg-4">

         <div class="card">
             <div class="card-header">
                 <div class="card-title">Tambah Pengguna</div>
             </div>
             <div class="card-body">
                 <div class="text-center mb-5">
                     <div class="widget-user-image">
                         <img alt="User Avatar" class="rounded-circle  mr-3"
                             src="{{ URL::asset('assets/images/users/2.jpg') }}">
                     </div>
                 </div>
                 <div class="form-group">
                     <label class="form-label">Nama Pengguna</label>
                     <input wire:model="name" type="text" class="form-control" placeholder="e.g: Asep Sunarya">
                     @error('name')
                         <small class="mt-2 text-danger">{{ $message }}</small>
                     @enderror
                 </div>
                 <div class="form-group">
                     <label class="form-label">Email Pengguna</label>
                     <input wire:model="email" type="email" class="form-control" placeholder="e.g: google@gmail.com"
                         {{ $selectedItemId ? 'readonly' : '' }}>
                     @error('email')
                         <small class="mt-2 text-danger">{{ $message }}</small>
                     @enderror
                 </div>
                 <div class="form-group">
                     <label class="form-label">Password</label>
                     <input wire:model="password" type="password" class="form-control"
                         placeholder="Masukkan Password">
                     @error('password')
                         <small class="mt-2 text-danger">{{ $message }}</small>
                     @enderror
                 </div>

                 <div class="form-group">
                     <label class="form-label">Pilih TSR</label>
                     <select class="custom-select" wire:model="tsr_id">
                         <option value="">Silahkan pilih pendamping</option>
                         @foreach ($users as $item)
                             <option value="{{ $item->id }}"> {{ $item->name }} </option>
                         @endforeach
                     </select>
                     @error('tsr_id')
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
                 <div class="card-title col-xl-3">Tabel Pengguna</div>

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

                         @if (count($users) != 0)
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Fullname</th>
                                     <th>Email</th>
                                     <th>Hak Akses</th>
                                     <th class="text-right">Aksi</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($users as $item)
                                     <tr>
                                         <th>{{ $loop->iteration }}</th>
                                         <td>{{ $item->name }}</td>
                                         <td>{{ $item->email }}</td>
                                         <td>{{ $item->hak_akses == '1' ? ($item->hak_akses == '1' ? 'Admin' : 'Pendamping') : ($item->hak_akses == '2' ? 'Pendamping' : 'Peternak') }}
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
