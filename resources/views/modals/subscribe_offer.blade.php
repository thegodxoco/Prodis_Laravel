<!-- Modal -->
<div class="modal fade" id="subscribeToOfferModel" tabindex="-1" aria-labelledby="subscribeToOfferModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subscribeToOfferModelLabel">{{ __("Atención") }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __("¿Quieres inscribirte en la oferta?") }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Cancelar") }}</button>
                <form action="{{ route('offers.subscribe', ['id' => $offer->id]) }}" method='post'>
                    @csrf
                    <button class="btn text-white btn-success" type="submit"> {{ __('Inscribirme en la oferta') }} </button>
                </form>
            </div>
        </div>
    </div>
</div>