 <div class="row">
     <div class="col-xl-3 col-lg-4">
         <div class="card">
             <div class="card-header">
                 <div class="card-title">Filter Pencarian</div>
             </div>
             <div class="card-body">
                 <div class="form-group">
                     <label>Tanggal</label>
                     <div wire:ignore class="input-group date mb-2" id="appointmentDateStart" data-target-input="nearest"
                         data-appointmentdatestart="@this">
                         <input type="text" class="form-control datetimepicker-input" data-target="#appointmentDateStart"
                             id="appointmentDateStartInput" data-toggle="datetimepicker" placeholder="Start Date">

                     </div>
                     <div wire:ignore class="input-group date" id="appointmentDateEnd" data-target-input="nearest"
                         data-appointmentdateend="@this">
                         <input type="text" class="form-control datetimepicker-input" data-target="#appointmentDateEnd"
                             id="appointmentDateEndInput" data-toggle="datetimepicker" placeholder="Date To">

                     </div>
                 </div>

                 <div class="form-group" hidden>
                     <label>Pencarian</label>
                     <input wire:model="searchTerm" type="search" class="form-control" placeholder="Search…"
                         aria-label="Search">
                 </div>
                 <div class="form-group">
                     <label>Pilih Sapi</label>
                     <select class="custom-select" wire:model="sapiId">
                         <option value="">Please Choose</option>
                         @foreach ($sapis as $item)
                             <option value="{{ $item->id }}"> {{ $item->nama_sapi }} </option>
                         @endforeach
                     </select>
                 </div>
                 <div class="form-group">
                     <label>Pilih Pendamping</label>
                     <select class="custom-select" wire:model="userId">
                         <option value="">Please Choose</option>
                         @foreach ($users as $item)
                             <option value="{{ $item->id }}"> {{ $item->name }} </option>
                         @endforeach
                     </select>
                 </div>
                 <div class="form-group">
                     <label class="form-label">Pilih Straw<span class="text-danger">*</span></label>
                     <select class="custom-select" wire:model="strowId">
                         <option value="">Please Choose</option>
                         @foreach ($strows as $item)
                             <option value="{{ $item->id }}"> {{ $item->kode_batch }} </option>
                         @endforeach
                     </select>
                 </div>

             </div>

         </div>
         <div class="card">
             <div class="card-header">
                 <div class="card-title">Tambah Insiminasi Buatan</div>
             </div>
             <div class="card-body">
                 <div class="text-center mb-5">
                     <div class="widget-user-image">
                         <img alt="User Avatar" class="rounded-circle  mr-3"
                             src="{{ URL::asset('assets/images/users/2.jpg') }}">
                     </div>
                 </div>
                 <div class="form-group">
                     <label class="form-label">S/C<span class="text-danger">*</span></label>
                     <input wire:model="dosis_ib" type="number" class="form-control" placeholder="e.g: 100CM">
                     @error('dosis_ib')
                         <small class="mt-2 text-danger">{{ $message }}</small>
                     @enderror
                 </div>
                 <div class="form-group">
                     <label class="form-label">Pilih Straw<span class="text-danger">*</span></label>
                     <select class="custom-select" wire:model="strow_id">
                         <option value="">Please Choose</option>
                         @foreach ($strows as $item)
                             <option value="{{ $item->id }}"> {{ $item->kode_batch }} </option>
                         @endforeach
                     </select>
                     @error('strow_id')
                         <small class="mt-2 text-danger">{{ $message }}</small>
                     @enderror
                 </div>
                 <div class="form-group">
                     <label class="form-label">Pilih Sapi<span class="text-danger">*</span></label>
                     <select class="custom-select" wire:model="sapi_id">
                         <option value="">Please Choose</option>
                         @foreach ($sapis as $item)
                             <option value="{{ $item->id }}"> {{ $item->nama_sapi }} </option>
                         @endforeach
                     </select>
                     @error('sapi_id')
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
                 <div class="card-title">Tabel Ternak</div>
             </div>
             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-hover card-table table-vcenter text-nowrap">

                         @if (count($insiminasi_buatans) != 0)
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Waktu IB</th>
                                     <th>S/C</th>
                                     <th>Strow</th>
                                     <th>Sapi</th>
                                     <th>Pendamping</th>
                                     <th class="text-right">Aksi</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($insiminasi_buatans as $item)
                                     <tr>
                                         <td>{{ $loop->iteration }}</td>
                                         <td>{{ $item->waktu_ib }}</td>
                                         <td>{{ $item->dosis_ib }}</td>
                                         <td>{{ $item->strow->kode_batch }}</td>
                                         <td>{{ $item->sapi->nama_sapi }}</td>
                                         <td>{{ $item->sapi->peternak->user->name }}</td>
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
 </div>
