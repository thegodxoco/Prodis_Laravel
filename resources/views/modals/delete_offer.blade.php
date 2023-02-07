<!-- Modal -->
<div class="modal fade" id="deleteOfferModel" tabindex="-1" aria-labelledby="deleteOfferModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteOfferModelLabel">{{ __("Atención") }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __("¿Quieres eliminar la oferta?") }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Cancelar") }}</button>
                <form action="/offer/edit/{{$offer->id}}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <input class="btn btn-danger m-3" type="submit" value="Eliminar" />
                </form>
            </div>
        </div>
    </div>
</div>