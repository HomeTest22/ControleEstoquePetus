
<!-- Modal -->
<form method="POST" action="../valida/valida_envio_suporte.php">
  <div class="modal fade bd-example-modal-lg" id="modal_suporte" tabindex="-1" role="dialog" aria-labelledby="modal_suporteTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div style="background-color:#e67e00;" class="modal-header">
          <h5 class="modal-title" style="color:white;" id="modal_alterarTitle">Suporte Online:</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="mensagem">Informe o problema:</label>
            <textarea name="mensagem" class="form-control" rows="7"></textarea>
          </div>
          <p>As solicitações de suporte serão respondidas via e-mail.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" style="background-color:#e67e00;" name="enviar" class="btn btn"><div style="color:white">Enviar mensagem</div></button>
        </div>
      </div>
    </div>
  </div>
</form>