<h2>Remover Usuário</h2>

<div class="form-field confirm-delete">
    <h3>Deseja realmente remover o Usuário "<?= $this->object->name ?>"?</h3>
    <form action="<?= $this->Url->make( "users/destroy" ) ?>" method="post">
        <div class="form-field">
            <input class="input-submit" type="submit" name="delete" value="Confirmar">
        </div>

        <!-- Token field -->
        <input type="hidden" name="token" value="<?= \lsm\libs\H::generateToken() ?>">
        <!-- Id field -->
        <input type="hidden" name="id" value="<?= $this->object->id ?>">
    </form>
    <a id="go-back" class="go-back input-submit" href="#">Voltar</a>
</div>
