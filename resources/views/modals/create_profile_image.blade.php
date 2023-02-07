<!-- Modal -->
<div class="modal fade" id="createProfileImageModel" tabindex="-1" aria-labelledby="createProfileImageModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProfileImageModelLabel">{{ __("Atención") }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __("¿Quieres subir la imagen?") }}
            </div>
            <div class="modal-footer">
                <form action="{{ route('users.image.store', ['user_id' => Auth::user()->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input class="btn btn-secondary m-3" type="file" name="profile_image" accept=".jpg, .jpeg, .png"/>
                    <input class="btn btn-success m-3" type="submit" value="{{ __('Añadir') }}" >
                </form>
            </div>
        </div>
    </div>
</div>