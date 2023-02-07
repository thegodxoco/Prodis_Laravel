<!-- Modal -->
<div class="modal fade" id="deleteProfileImageModel" tabindex="-1" aria-labelledby="deleteProfileImageModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProfileImageModelLabel">{{ __("Atención") }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __("¿Quieres eliminar la imagen?") }}
            </div>
            <div class="modal-footer" style="display:flex; flex-direction:row;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Cancelar") }}</button>
                <form action="{{ route('users.image.destroy', ['id' => Auth::user()->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input class="btn btn-danger m-3" type="submit" value="Eliminar" />
                </form>
            </div>
        </div>
    </div>
</div>