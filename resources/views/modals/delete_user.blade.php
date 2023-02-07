<!-- Modal -->
<div class="modal fade" id="deleteUserModel{{$user->id}}" tabindex="-1" aria-labelledby="deleteUserModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModelLabel">{{ __("Atención") }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __("¿Quieres eliminar este usuario?") }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Cancelar") }}</button>
                <input type="submit" class="btn btn-danger" value="{{ __('Eliminar') }}"/>
            </div>
        </div>
    </div>
</div>