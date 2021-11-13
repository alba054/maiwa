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
                     <label class="form-label">No Hp</label>
                     <input wire:model="no_hp" type="number" class="form-control" placeholder="e.g: 08123456789">
                     @error('no_hp')
                         <small class="mt-2 text-danger">{{ $message }}</small>
                     @enderror
                 </div>
                 <div class="form-group">
                     <label class="form-label">Alamat</label>
                     <input wire:model="alamat" type="text" class="form-control"
                         placeholder="e.g: Jl. Perintis Kemerdekaan">
                     @error('alamat')
                         <small class="mt-2 text-danger">{{ $message }}</small>
                     @enderror
                 </div>
                 @if ($hak_akses == '3')
                     <div class="form-group">
                         <label class="form-label">Pilih TSR</label>
                         <select class="custom-select" wire:model="tsr_id">
                             <option value="">Pilih TSR</option>
                             @foreach ($tsrs as $item)
                                 <option value="{{ $item->id }}"> {{ $item->user->name }} </option>
                             @endforeach
                         </select>
                         @error('tsr_id')
                             <small class="mt-2 text-danger">{{ $message }}</small>
                         @enderror
                     </div>
                 @endif


                 <div class="dimmer active" style="height: 5px; margin-top: 0;" wire:loading>
                     <div class="spinner4">
                         <div class="bounce1"></div>
                         <div class="bounce2"></div>
                         <div class="bounce3"></div>
                     </div>
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
                                     <th>No Hp</th>
                                     <th>Alamat</th>
                                     @if ($hak_akses == 3)
                                         <th>TSR</th>
                                     @endif
                                     <th class="text-right">Aksi</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($users as $item)
                                     <tr>
                                         <th>{{ $loop->iteration }}</th>
                                         <td>{{ $item->name }}</td>
                                         <td>{{ $item->email }}</td>
                                         <td>{{ $item->hak_akses == '1' ? ($item->hak_akses == '1' ? 'Admin' : 'TSR') : ($item->hak_akses == '2' ? 'TSR' : 'Pendamping') }}

                                         </td>
                                         <td>{{ $item->no_hp }}</td>
                                         <td>{{ $item->alamat }}</td>
                                         @if ($hak_akses == 3)
                                             <td>{{ $pendampings->where('user_id', $item->id)->first()->tsr->user->name }}
                                             </td>
                                         @endif
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
