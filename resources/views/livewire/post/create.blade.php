@push('style')
    <style>
        .inputfile+label {
            font-size: 1.25em;
            font-weight: 700;
            color: white;
            background-color: black;
            display: inline-block;
        }

        .inputfile:focus+label,
        .inputfile+label:hover {
            background-color: red;
        }

    </style>
@endpush
<form class="card" wire:submit.prevent="submit" enctype="multipart/form-data">
    @csrf
    <div class="card-header">
        <h3 class="card-title">add Post </h3>
    </div>
    <div class="card-body ">
        <div class="form-group row">
            <div class="col-md-12">
                <label class="form-label">Post Title</label>
                <input wire:model="state.title" class="form-control @error('title') is-invalid @enderror"
                    placeholder="Post title" value="{{ $post->title }}" autofocus>

                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label>Select Tags</label>
                <div class="@error('tags') is-invalid @enderror">
                    <x-input.select2 wire:model="state.tags" id="tags" placeholder="Select Tags">
                        @foreach ($tags as $item)
                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                        @endforeach

                    </x-input.select2>
                </div>
                @error('tags')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        {{-- <div class="form-group">
            <label class="form-label">Post Image</label>
            <div class="@error('images') is-invalid @enderror">
                <x-input.dropify wire:model="state.images" id="images"></x-input.dropify>
            </div>

            @error('images')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div> --}}

        <div class="form-group">
            <label class="form-label">Post Detail</label>

            <div class="@error('detail') is-invalid @enderror">
                <x-input.textarea wire:model="state.detail" id="detail">
                </x-input.textarea>
            </div>

            @error('detail')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <div class="form-label">Post Image</div>
            <input class="form-control" type="file" id="formFile" wire:model="images">

            @error('images')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            @if ($images)
                <img src="{{ $images->temporaryUrl() }}" class="mt-2" style="height: 200px">
            @endif
        </div>
        <div class="form-group">
            <label>Foto Perlakuan<span class="text-danger">*</span></label>
            <input class="form-control inputfile" type="file" id="formFile" wire:model="foto">
            @error('foto')
                <small class="mt-2 text-danger">{{ $message }}</small>
            @enderror

            @if ($foto)
                <img src="{{ $foto->temporaryUrl() }}" class="mt-2">
            @endif
        </div>

        <input type="file" name="file" id="file" class="inputfile" style="font-size: 1.25em;
        font-weight: 700;
        color: white;
        background-color: black;
        display: inline-block;" />
        <label for="file">Choose a file</label>

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-success"><i class="fe fe-plus"></i> Add
                        New
                        Invoice</button>
                    <a class="btn btn-light" href="#">Cancel</a>
                </div>
            </div>
        </div>
</form>

@push('script')
    <!-- INTERNAL Select2 js -->
    <script src="{{ URL::asset('assets/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>

    <!-- INTERNAL File uploads js -->
    <script src="{{ URL::asset('assets/plugins/fileupload/js/dropify.js') }}"></script>
    <script src="{{ URL::asset('assets/js/filupload.js') }}"></script>

    <!-- INTERNAL WYSIWYG Editor js -->
    <script src="{{ URL::asset('assets/plugins/wysiwyag/jquery.richtext.js') }}"></script>
    <script src="{{ URL::asset('assets/js/form-editor.js') }}"></script>

    <script>
        // $('.select2').select().on('change', function() {
        //     @this.set('state.tags', $('#tags').val());

        // });
        // // $('.dropify').select().on('change', function() {
        // //     @this.set('state.images', $('#images').val());

        // // });

        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong appended.'
            },
            error: {
                'fileSize': 'The file size is too big (2M max).'
            }
        }).on('change', function() {

            var file = $('#images').prop('files')[0];
            // alert(file)
            // console.log(file);
            var fileReader = new FileReader();
            fileReader.onload = function() {
                var data = fileReader.result; // data <-- in this var you have the file data in Base64 format
                console.log(data);

            };
            var datas = fileReader.readAsDataURL(file);
            console.log(datas);
            @this.set('state.images', datas);

        });

        $('form').submit(function() {
            @this.set('state.tags', $('#tags').val());

            @this.set('state.detail', $('#detail').val());
        })
    </script>
@endpush
