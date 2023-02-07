<!-- Modal -->
<div class="modal fade" id="deleteCategoryModel" tabindex="-1" aria-labelledby="deleteCategoryModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCategoryModelLabel">{{ __("Atención") }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __("¿Quieres eliminar la categoria?") }}
                <br>
                <b>
                    {{ __("¡TODAS las ofertas que tienen asignada esta categoría la perderan!") }}
                </b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Cancelar") }}</button>
                <button type="button" id="delete_category" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCategoryModel"> {{ __('Eliminar categoría') }} </button>
            </div>
        </div>
    </div>
</div>