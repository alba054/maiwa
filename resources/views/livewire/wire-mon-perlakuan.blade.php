 <div class="row">
     <div class="col-12 mb-4">

         <button wire:click="create" class="btn btn-primary"><i class="fe fe-plus"></i>
             Tambahkan Perlakuan</button>

     </div>

     <div class="col-xl-12 col-lg-12">
         <div class="card">
             <div class="card-header">

                 <div class="col">
                     <div class="card-title">Tabel Perlakuan</div>
                 </div>

             </div>
             <div class="card-body">
                 <div class="row">
                     <div class="col-sm-2">
                         <div class="form-group">

                             <div wire:ignore class="input-group date" id="appointmentDateStart"
                                 data-target-input="nearest" data-appointmentdatestart="@this">
                                 <input type="text" class="form-control datetimepicker-input"
                                     data-target="#appointmentDateStart" id="appointmentDateStartInput"
                                     data-toggle="datetimepicker" placeholder="Start Date">

                             </div>
                         </div>
                     </div>
                     <div class="col-sm-2">
                         <div class="form-group">


                             <div wire:ignore class="input-group date" id="appointmentDateEnd"
                                 data-target-input="nearest" data-appointmentdateend="@this">
                                 <input type="text" class="form-control datetimepicker-input"
                                     data-target="#appointmentDateEnd" id="appointmentDateEndInput"
                                     data-toggle="datetimepicker" placeholder="Date To">

                             </div>

                         </div>
                     </div>

                     <div class="col-sm-4">
                         <div class="form-group">
                             <select class="custom-select" wire:model="sapiId">
                                 <option value="">Pilih Sapi</option>
                                 @foreach ($sapis as $item)
                                     <option value="{{ $item->id }}"> {{ $item->nama_sapi }} </option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                     <div class="col-sm-4">
                         <div class="form-group">
                             <select class="custom-select" wire:model="userId">
                                 <option value="">Pilih Pendamping</option>
                                 @foreach ($users as $item)
                                     <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="table-responsive">
                     <table class="table table-hover card-table table-vcenter text-nowrap">

                         @if (count($perlakuans) != 0)
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Pendamping</th>
                                     <th>sapi</th>
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

                                     <th class="text-right">Aksi</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($perlakuans as $item)
                                     <tr>
                                         <td>{{ $loop->iteration }}</td>
                                         <td>{{ $item->sapi->peternak->user->name }}</td>
                                         <td>{{ $item->sapi->nama_sapi }}</td>
                                         <td>{{ $item->tgl_perlakuan }}</td>
                                         <td>{{ $item->jenis_obat }}</td>
                                         <td>{{ $item->dosis_obat }}</td>
                                         <td>{{ $item->vaksin }}</td>
                                         <td>{{ $item->dosis_vaksin }}</td>
                                         <td>{{ $item->vitamin }}</td>
                                         <td>{{ $item->dosis_vitamin }}</td>
                                         <td>{{ $item->hormon }}</td>
                                         <td>{{ $item->dosis_hormon }}</td>
                                         <td>{{ $item->ket_perlakuan }}</td>

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
     <div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal">
         <div class="modal-dialog" role="document">
             @livewire('wire-mon-perlakuan-form')

         </div>
     </div>
 </div>
