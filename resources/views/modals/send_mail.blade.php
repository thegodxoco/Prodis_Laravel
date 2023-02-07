<!-- Modal -->
<div class="modal fade" id="sendMailModel" tabindex="-1" aria-labelledby="sendMailModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendMailModelLabel">{{ __("Atención") }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __("¿Quieres enviar el email?") }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Cancelar") }}</button>
                <button type="submit" class="btn btn-block col-3 text-white btn-success">{{  __('Enviar') }}</button>
            </div>
        </div>
    </div>
</div>