<!-- Modal -->
<div class="modal fade" id="createCategoryModel" tabindex="-1" aria-labelledby="createCategoryModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModelLabel">{{ __("Atención") }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __("¿Quieres crear la categoria?") }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Cancelar") }}</button>
                <button type="button" id="add_category" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModel"> {{ __('Añadir categoría') }} </button>
            </div>
        </div>
    </div>
</div>