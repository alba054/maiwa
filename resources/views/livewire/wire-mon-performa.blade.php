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

             </div>

         </div>
         <div class="card">
             <div class="card-header">
                 <div class="card-title">Performa</div>
             </div>
             <div class="card-body">
                 <div class="text-center mb-5">
                     <div class="widget-user-image">
                         <img alt="User Avatar" class="rounded-circle  mr-3"
                             src="{{ URL::asset('assets/images/users/2.jpg') }}">
                     </div>
                 </div>
                 <div class="form-group">
                     <label class="form-label">Tinggi Badan<span class="text-danger">*</span></label>
                     <input wire:model="tinggi_badan" type="number" class="form-control" placeholder="e.g: 100CM">
                     @error('tinggi_badan')
                         <small class="mt-2 text-danger">{{ $message }}</small>
                     @enderror
                 </div>
                 <div class="form-group">
                     <label class="form-label">Berat Badan<span class="text-danger">*</span></label>
                     <input wire:model="berat_badan" type="number" class="form-control" placeholder="e.g: 100KG">
                     @error('berat_badan')
                         <small class="mt-2 text-danger">{{ $message }}</small>
                     @enderror
                 </div>
                 <div class="form-group">
                     <label class="form-label">Panjang Badan<span class="text-danger">*</span></label>
                     <input wire:model="panjang_badan" type="number" class="form-control" placeholder="e.g: 100CM">
                     @error('panjang_badan')
                         <small class="mt-2 text-danger">{{ $message }}</small>
                     @enderror
                 </div>
                 <div class="form-group">
                     <label class="form-label">Lingkar Dada<span class="text-danger">*</span></label>
                     <input wire:model="lingkar_dada" type="number" class="form-control" placeholder="e.g: 100CM">
                     @error('lingkar_dada')
                         <small class="mt-2 text-danger">{{ $message }}</small>
                     @enderror
                 </div>
                 <div class="form-group">
                     <label class="form-label">BCS<span class="text-danger">*</span></label>
                     <select class="custom-select" wire:model="bsc">
                         <option value="">Please Choose</option>
                         <option value="1"> 1 </option>
                         <option value="2"> 2 </option>
                         <option value="3"> 3 </option>
                         <option value="4"> 4 </option>
                         <option value="5"> 5 </option>

                     </select>
                     @error('bsc')
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

                         @if (count($perfromas) != 0)
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Tanggal Performa</th>
                                     <th>Tinggi Badan</th>
                                     <th>Berat Badan</th>
                                     <th>Panjang Badan</th>
                                     <th>Lingkar Dada</th>
                                     <th>BSC</th>
                                     <th>Sapi</th>
                                     <th>Pendamping</th>
                                     <th class="text-right">Aksi</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($perfromas as $item)
                                     <tr>
                                         <td>{{ $loop->iteration }}</td>
                                         <td>{{ $item->tanggal_performa }}</td>
                                         <td>{{ $item->tinggi_badan }}</td>
                                         <td>{{ $item->berat_badan }}</td>
                                         <td>{{ $item->panjang_badan }}</td>
                                         <td>{{ $item->lingkar_dada }}</td>
                                         <td>{{ $item->bsc }}</td>
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
