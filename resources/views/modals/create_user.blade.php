<!-- Modal -->
<div class="modal fade" id="createUserModel" tabindex="-1" aria-labelledby="createUserModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModelLabel">{{ __("Atención") }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __("¿Quieres crear el usuario?") }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-block col-3" data-bs-dismiss="modal">{{ __("Cancelar") }}</button>
                <button type="submit" class="btn btn-block col-3 text-white btn-success">{{  __('Crea') }}</button>
            </div>
        </div>
    </div>
</div>