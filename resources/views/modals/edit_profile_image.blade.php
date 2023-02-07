<!-- Modal -->
<div class="modal fade" id="editProfileImageModel" tabindex="-1" aria-labelledby="editProfileImageModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileImageModelLabel">{{ __("Atención") }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __("¿Quieres cambiar la imagen?") }}
            </div>
            <div class="modal-footer d-flex">
                <form action="{{ route('users.image.update', [ 'user_id' => Auth::user()->id]) }}" method="POST" enctype="multipart/form-data">    
                    @csrf
                    @method('PUT')
                    <input type="file" class="btn btn-secondary m-3" name="profile_image" value="Cambiar" />
                    <input class="btn btn-success m-3" type="submit" value="Cambiar" />
                </form>

            </div>
        </div>
    </div>
</div>