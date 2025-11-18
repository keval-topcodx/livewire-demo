<div class="mt-3 container p-5 border shadow-lg rounded-3">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="header text-center">
        <h3>Create Product</h3>
    </div>
    <form class="form" wire:submit="submit">
        <div class="row g-3">
            <div class="col-md-6">
                <x-input name="title" label="Title" type="text" model="title" placeholder="Enter Title" />
            </div>
            <div class="col-md-6">
                <x-input name="description" label="Description" type="text" model="description" placeholder="Enter Description" />
            </div>
        </div>


        <div class="row">
            <div class="mt-3">
                <label>Status:</label>
                <div>
                    <x-radio id="active" name="status" model="status" value="1" label="Active" />
                    <x-radio id="inactive" name="status" model="status" value="0" label="Inactive" />
                </div>
            </div>
            @error('status')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-3">
            <label>Images:</label>
            <div class="image-select border p-4 text-center bg-light" style="cursor: pointer;"
                 ondragover="event.preventDefault()"
                 ondrop="handleDrop(event)">
                <p>Drag and drop file or click to browse</p>
                <input type="file" wire:model="images" class="d-none" id="fileInput" multiple>
                @if($images)
                <p><strong>Preview:</strong></p>
                    <div class="mt-3 d-flex gap-3">
                    @foreach($images as $image)
                        <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail" style="max-width: 150px;" alt="Image">
                    @endforeach
                    </div>
                @endif
            </div>
            @error('images')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-3">
            <h4>Variants:</h4>
            <div class="row">
                <div class="col-md-3"><label>Title:</label></div>
                <div class="col-md-3"><label>Price:</label></div>
                <div class="col-md-3"><label>Sku:</label></div>
                <div class="col-md-3"><button class="btn btn-success" type="button" wire:click="addVariant">+ ADD VARIANT</button></div>
            </div>
            @foreach($variants as $index => $variant)
                <div class="row mt-3">
                    <div class="col-md-3">
                        <input type="text" name="title" class="form-control" wire:model="variants.{{$index}}.title" placeholder="Title">
                        @error('variants.' . $index . '.title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-md-3">
                        <input type="number" name="price" class="form-control" wire:model="variants.{{$index}}.price" step="0.01"  placeholder="Price">
                        @error('variants.' . $index . '.price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="sku" class="form-control" wire:model="variants.{{$index}}.sku"  placeholder="Sku">
                        @error('variants.' . $index . '.sku')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <button type="button" class="btn btn-outline-danger" wire:click="removeVariant({{$index}})">X</button>
                    </div>

                </div>

            @endforeach

        </div>

        <div class="mt-3">
            <h4>Tags:</h4>
            <div wire:ignore>
                <select class="form-control js-example-tags" wire:model="tag_ids" multiple="multiple">
                    <option disabled>--Select Tags</option>
                    @if($tags)
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="mt-3">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>
</div>
@script
<script>
        document.addEventListener("livewire:initialized", () => {
            function initializeSelect2() {
                $(".js-example-tags").select2({
                    tags: true
                });
                $('.js-example-tags').on('change', function () {
                    @this.set('tag_ids', $(this).val());
                });
            }
            initializeSelect2();
            Livewire.hook('morphed', () => initializeSelect2());
        });


    function handleDrop(event) {
        event.preventDefault();
    @this.upload("images", event.dataTransfer.files[0]);
    }
    document.querySelector(".image-select").addEventListener("click", function() {
        document.getElementById("fileInput").click();
    });
</script>
@endscript
