<!-- Modal -->
<div class="modal fade" id="saveUserChangesModel" tabindex="-1" aria-labelledby="saveUserChangesModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="saveUserChangesModelLabel">{{ __("Atención") }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __("¿Quieres guardar los cambios?") }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Cancelar") }}</button>
                {{-- <button type="submit" class="btn btn-success btn-block col-3">{{  __('Crea') }}</button> --}}
                <button type="submit" class="btn btn-primary">{{ __('Actualizar') }}</button>
            </div>
        </div>
    </div>
</div>