<!-- Modal -->
<div class="modal fade" id="unsubscribeToOfferModel" tabindex="-1" aria-labelledby="unsubscribeToOfferModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="unsubscribeToOfferModelLabel">{{ __("Atención") }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __("¿Quieres desuscribirte de la oferta?") }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Cancelar") }}</button>
                <form action="{{ route('offers.unsubscribe', ['id' => $offer->id]) }}" method='post'>
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit"> {{ __('Desuscribir') }} </button>
                </form>
            </div>
        </div>
    </div>
</div>