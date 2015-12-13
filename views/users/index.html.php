<?php
$msgClass = false;

if ( isset( $_SESSION[ 'success-msg' ] ) ) {
    $msg = H::flash( 'success-msg' );
    $msgClass = 'success-msg';
} else if ( isset( $_SESSION[ 'err-msg' ] ) ) {
    $msg = H::flash( 'err-msg' );
    $msgClass = 'err-msg';
}
?>

<div class="console">
    <!-- Adicionar -->
    <a href="<?= $this->Url->make( "users/create" ) ?>" class="input-submit btn-green">Adicionar</a>

    <div class="console-toggle">
        <!-- Ativar -->
        <button name="btn-activate" class="input-submit">Ativar</button>

        <!-- Desativar -->
        <button name="btn-deactivate" class="input-submit">Desativar</button>
    </div>

    <!-- Excluir -->
    <button name="btn-delete" class="input-submit btn-red">Excluir</button>

    <div class="search" title="Pode usar parte do nome ou email">
        <form id="users-search-form" class="search-form" action="<?= $this->Url->make( 'users/' ) ?>">
            <div class="form-field">
                <input placeholder="Pesquisar Usuários" title="Pode-se pesquisar por nome ou e-mail"
                       id="search" type="text" name="search" value="<?= Request::getInstance()->getInput( 'search', false ); ?>">
            </div>
            <input class="input-submit" type="submit" value="Buscar">
            <a href="<?= $this->Url->make( 'users/' ) ?>">Limpar pesquisa</a>
        </form>
    </div>
</div>

<h2 id="area-header">Users</h2>

<?php if ( isset( $msg ) ): ?>
    <div class="flash <?= $msgClass ?>">
        <?= $msg ?>
    </div>
<?php endif; ?>

<?php if ( $this->objectList != null ): ?>
<table>
    <thead>
    <tr>
        <th><input id="toggle-all" type="checkbox" name="toggle-all" title="Selecionar todos"></th>
        <th>Name</th>
        <th>E-mail</th>
        <th>Status</th>
        <?php if ( $this->editOtherUsers ) : ?>
        <th>Editar</th>
        <th>Remover</th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ( $this->objectList as $user ) : ?>
        <tr>
            <td><input type="checkbox" class="list-item" name="li[]" value="<?= $user->id ?>"></td>
            <td><?= $user->name; ?></td>
            <td><?= $user->email; ?></td>
            <td>
                <div class="onoffswitch" title="<?= $user->getStatus( true ); ?>">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"
                           value="<?= $user->id ?>"
                           id="myonoffswitch-<?= $user->id ?>" <?= ( $user->status ) ? "checked" : "" ?>>
                    <label class="onoffswitch-label" for="myonoffswitch-<?= $user->id ?>">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </td>
            <?php if ( $this->editOtherUsers ) : ?>
            <td>
                <a class="input-submit btn-edit" href="<?= $this->Url->make( "users/{$user->id}/edit" ) ?>">Editar</a>
            </td>
            <td>
                <a class="input-submit btn-delete" href="<?= $this->Url->make( "users/{$user->id}/delete" ) ?>">Excluir</a>
            </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script src="<?= $this->Url->make( 'js/form.js' ); ?>" type="text/javascript"></script>
<script src="<?= $this->Url->make( 'js/user.js' ); ?>" type="text/javascript"></script>

<?php else: ?>
<p class="msg-notice">Não há usuários cadastrados.</p>
<?php endif; ?>

<!-- Token field -->
<input id="token" type="hidden" name="token" value="<?= H::generateToken() ?>">
