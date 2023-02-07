
<!-- Modal -->
<div class="modal fade" id="editOfferImageModel{{$index}}" tabindex="-1" aria-labelledby="editOfferImageModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOfferImageModelLabel">{{ __("Atención") }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __("¿Quieres cambiar la imagen?") }}
            </div>
            <div class="modal-footer d-flex">
                <form action="{{ route('offers.images.update', [ 'offer_id' => $offer->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="offer_image_id" value="{{$offer->images[$index]['id']}}">
                    <input type="file" class="btn btn-secondary m-3" name="offer_image" accept=".jpg, .jpeg, .png" />
                    <input class="btn btn-success m-3" type="submit" value="{{ __('Cambiar') }}" />
                </form>
                {{-- <button type="button" onclick="deleteImage({{$offer->id}}, {{$offer->images[$index]['id']}})" class="btn btn-danger mt-2 btn-block col-3"
                    data-bs-toggle="modal" data-bs-target="#editOfferImageModel{{$index}}">{{ __('Eliminar')}}</button> --}}
            </div>
        </div>
    </div>
</div>