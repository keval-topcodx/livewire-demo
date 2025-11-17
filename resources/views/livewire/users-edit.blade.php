<div class="mt-3 container p-5 border shadow-lg rounded-3">
    @if (session('status'))
        <div class="alert alert-success mt-3">
            {{ session('status') }}
        </div>
    @endif
    <div class="header text-center">
        <h3>Edit User</h3>
    </div>

    <form class="form" wire:submit="submit">
        <div class="row g-3">
            <div class="col-md-6">
                <x-input name="first_name" label="First Name" type="text" model="first_name" placeholder="Enter First Name" />
            </div>
            <div class="col-md-6">
                <x-input name="last_name" label="Last Name" type="text" model="last_name" placeholder="Enter Last Name" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <x-input name="email" label="Email Id:" type="text" model="email" placeholder="Enter Email Id" />
            </div>
            <div class="col-md-6">
                <x-input name="phono_no" label="Phone Number:" type="number" model="phone_no" placeholder="Enter Phone No" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <x-input name="password" label="Password:" type="password" model="password" placeholder="Enter Password" />
            </div>
            <div class="col-md-6">
                <x-input name="password_confirmation" label="Confirm Password:" type="password" model="password_confirmation" placeholder="Enter Password Again" />
            </div>
        </div>

        <div class="row">
            <div class="mt-3">
                <label>Gender:</label>
                <div>
                    <x-radio id="male" name="gender" model="gender" value="male" label="Male" />
                    <x-radio id="female" name="gender" model="gender" value="female" label="Female" />
                </div>
            </div>
            @error('gender')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="row">
            <div class="mt-3">
                <label>Hobbies:</label>
                <div>
                    <x-checkbox model="hobbies" value="football" label="Football" />
                    <x-checkbox model="hobbies" value="movies" label="Movies" />
                    <x-checkbox model="hobbies" value="music" label="Music" />
                    <x-checkbox model="hobbies" value="travelling" label="Travelling" />
                    <x-checkbox model="hobbies" value="gaming" label="Gaming" />
                </div>
            </div>
            @error('hobbies')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="mt-3">
            <label>Image:</label>
            <div class="image-select border p-4 text-center bg-light" style="cursor: pointer;"
                 ondragover="event.preventDefault()"
                 ondrop="handleDrop(event)">
                <p>Drag and drop file or click to browse</p>
                <input type="file" wire:model="image" class="d-none" id="fileInput">
                <div class="mt-3">
                    <p><strong>Preview:</strong></p>
                    <img src="{{$image ? $image->temporaryUrl() : $image_url }}" class="img-thumbnail" style="max-width: 150px;" alt="Image">
                </div>
            </div>
            @error('image')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-3">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>
</div>
<script>
    function handleDrop(event) {
        event.preventDefault();
    @this.upload("image", event.dataTransfer.files[0]);
    }
    document.querySelector(".image-select").addEventListener("click", function() {
        document.getElementById("fileInput").click();
    });
</script>
