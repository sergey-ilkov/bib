<div id="model-delete" class="modal-delete">
    <div class="modal-body">
        <x-admin.form id="form-delete" action="" method="DELETE" class="card-form">
            <x-admin.form-item>
                <h3 class="modal__title title-h3">

                    {{__('admin.form.del')}}

                </h3>
            </x-admin.form-item>
            <div class="modal__buttons">
                <x-admin.button type="sumbit" class="card-form__btn btn-delete">

                    {{__('Delete')}}

                </x-admin.button>
                <x-admin.button class="card-form__btn btn-cancel btn-modal-close">

                    {{__('Cancel')}}

                </x-admin.button>
            </div>
        </x-admin.form>
    </div>
</div>