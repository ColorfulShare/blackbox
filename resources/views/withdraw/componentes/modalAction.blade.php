<div class="modal fade" id="modalModalAccion" tabindex="-1" role="dialog" aria-labelledby="modalModalAccionTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="modalModalAccionTitle" v-text="(StatusProcess == 'reverse') ? 'Reversar Liquidacion' : 'Aprobar Liquidacion'"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-justify">
                <form action="{{route('withdraw.retirement')}}" method="post">
                    @csrf
                    <input type="hidden" name="idliquidation" :value="ComisionesDetalles.idliquidation">
                    <input type="hidden" name="user_id" :value="ComisionesDetalles.user_id">
                    <input type="hidden" name="fullname" :value="ComisionesDetalles.fullname">
                    <input type="hidden" name="total" :value="ComisionesDetalles.total">

                    <input type="hidden" name="action" :value="StatusProcess">
                    <h5 class="text-white">Usuario: <strong v-text="ComisionesDetalles.fullname"></strong></h5>
                    <br>
                    <h5 class="text-white">Total: <strong v-text="ComisionesDetalles.total"></strong></h5>
                    <br>
                    <div class="form-group" v-if="StatusProcess == 'aproved'">
                        <label for="">Hash</label>
                        <input type="text" name="hash" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="">Comentario</label>
                        <textarea name="comentario" class="form-control" :required="(StatusProcess == 'reverse') ? true : false"></textarea>
                    </div>

                    <div class="form-group text-center mt-3">
                        <button class="btn btn-outline-primary" v-text="(StatusProcess == 'reverse') ? 'Reversar' : 'Aprobar'"></button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>