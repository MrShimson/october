<?php Block::put('breadcrumb') ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Backend::url('october/management/employees') ?>">Employees</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= e($this->pageTitle) ?></li>
    </ol>
<?php Block::endPut() ?>

<?php if (!$this->fatalError): ?>

    <?= Form::open(['class' => 'employee-form']) ?>

        <?= $this->makePartial('form-fields') ?>

        <div class="form-buttons">
            <div data-control="loader-container">
                <button
                    type="submit"
                    data-request="onSave"
                    data-request-message="<?= __("Creating :name...", ['name' => $formRecordName]) ?>"
                    data-hotkey="ctrl+s, cmd+s"
                    class="btn btn-primary">
                    <?= __("Create") ?>
                </button>
                <button
                    type="button"
                    data-request="onSave"
                    data-request-data="{ close: 1 }"
                    data-request-message="<?= __("Creating :name...", ['name' => $formRecordName]) ?>"
                    data-hotkey="ctrl+enter, cmd+enter"
                    class="btn btn-default">
                    <?= __("Create & Close") ?>
                </button>
                <span class="btn-text">
                    <span class="button-separator"><?= __("or") ?></span>
                    <a
                        href="<?= Backend::url('october/management/employees') ?>"
                        class="btn btn-link p-0">
                        <?= __("Cancel") ?>
                    </a>
                </span>
            </div>
        </div>

    <?= Form::close() ?>

<?php else: ?>

    <p class="flash-message static error">
        <?= e($this->fatalError) ?>
    </p>
    <p>
        <a
            href="<?= Backend::url('october/management/employees') ?>"
            class="btn btn-default">
            <?= __("Return to List") ?>
        </a>
    </p>

<?php endif ?>
