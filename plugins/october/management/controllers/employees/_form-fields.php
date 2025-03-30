<div class="employee-form__fields">
    <?= $this->formRender() ?>
</div>

<style>
    .employee-form {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .employee-form__fields {
        flex-grow: 1;
    }

    .employee-form .form-tabless-fields  {
        gap: 30px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
    }

    .employee-form .form-tabless-fields::before,
    .employee-form .form-tabless-fields::after {
        display: none;
    }

    @media screen and (max-width: 1200px) {
        .employee-form .form-tabless-fields {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media screen and (max-width: 768px) {
        .employee-form .form-tabless-fields {
            grid-template-columns: 1fr;
        }
    }
</style>
