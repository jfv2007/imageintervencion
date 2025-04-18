<div>

    @if (Session::has('success'))
        <span style="color: green; font-weight: bold;"> {{ Session::get('success')}} </span>

    @endif

    <form wire:submit.prevent="save">
        <input type="file" wire:model="photo">
        @if ($photo)
            Photo Preview:
            <img src="{{ $photo->temporaryUrl() }}" width="100">
        @endif

        @error('photo') <span class="error">{{ $message }}</span> @enderror
        <input type="text" placeholder="name" wire:model="name">
        <input type="text" placeholder="content" wire:model="content">


        <button type="submit">Save Photo</button>
    </form>

</div>
