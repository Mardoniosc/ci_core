<div class="form-group">
  <label>Nome Completo</label>
  <input type="text" placeholder="Insira o nome completo" class="form-control" name="nome" value="<?php echo esc($usuario->nome);?>">
</div>

<div class="form-group">
  <label>E-mail</label>
  <input type="email" placeholder="Insira o e-mail de acesso" class="form-control" name="email" value="<?php echo esc($usuario->email);?>">
</div>

<div class="form-group">
  <label>Senha</label>
  <input type="password" placeholder="Senha de acesso" class="form-control" name="password" >
</div>

<div class="form-group">
  <label>Confirmação de Senha</label>
  <input type="password" placeholder="Confirma e senha de acesso" class="form-control" name="password_confirmation" >
</div>

<div class="form-group">
  <input type="hidden" name="ativo" value="f">

  <label> 
    <input type="checkbox" class="i-checks" name="ativo" value="t" <?php if($usuario->ativo == 't'): ?> checked <?php endif; ?>> 
    Usuário ativo 
  </label>
</div>

