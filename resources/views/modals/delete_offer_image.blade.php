<!-- Modal -->
<div class="modal fade" id="deleteImageModel{{$index}}" tabindex="-1" aria-labelledby="deleteImageModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteImageModelLabel">{{ __("Atención") }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __("¿Quieres eliminar la imagen?") }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Cancelar") }}</button>
                <button type="button" onclick="deleteImage({{$offer->id}}, {{$offer->images[$index]['id']}})" class="btn btn-danger btn-block col-3"
                    data-bs-toggle="modal" data-bs-target="#deleteImageModel{{$index}}">{{ __('Eliminar')}}</button>
            </div>
        </div>
    </div>
</div>