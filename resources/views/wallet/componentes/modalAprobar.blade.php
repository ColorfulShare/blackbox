<!-- Modal -->
<div class="modal fade" id="openModalAprobar" tabindex="-1" role="dialog" aria-labelledby="modalModalAprobarTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="modalModalAprobarTitle">Aprobar Retiro</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-justify">
                <form action="{{route('settlement.process')}}" method="post">
                    @csrf
                    <input type="hidden" name="idliquidation" value="idliquidacion">
                    <input type="hidden" name="action" value="aproved">
                    <input type="hidden" name="wallet" value="wallet">

                    <div class="form-group">
                        <label for="">Codigo Correo</label>
                        <input type="text" name="correo_code" class="form-control" required>
                        <div class="col-12 text-center mt-1">
                            <button type="button" class="btn btn-primary" v-on:click='sendCodeEmail' onclick="sendCodeEmail()" v-if='idliquidacion == 0'>Enviar Codigo</button>
                            <br><br>
                            <span class='' v-else>Codigo Enviado, tienes 30 min sino se cancelara el retiro automaticamente</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Codigo Google</label>
                        <input type="text" name="google_code" class="form-control" required>
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-primary mt-2">Aprobar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>