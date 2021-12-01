<!-- Modal -->
<div class="modal fade" id="modalModalDetalles" tabindex="-1" role="dialog" aria-labelledby="modalModalDetallesTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="background: #283046;">
            <div class="modal-header" style="background: #283046;">
                <h4 class="modal-title text-white" id="modalModalDetallesTitle">Detalles de comisiones del usuario: <span class="fw-bold">@{{ComisionesDetalles.fullname}}</span></h4>
                <a type="button" class="text-white" data-bs-dismiss="modal" aria-label="Close">
                X
                </a>
            </div>
            <div class="modal-body text-justify">
                <form action="{{route('liquidation.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="tipo" value="detallada">
                    <input type="hidden" name="user_id" :value="ComisionesDetalles.user_id">
                    <table class="table nowrap scroll-horizontal-vertical table-striped" style="width: 100%">
                        <thead>
                            <tr class="text-center">
                                @if ($all)
                                <th>
                                    <button type="button" class="btn btn-primary" :class="(seleAllComision) ? 'btn-danger' : 'btn-success'" v-on:click="seleAllComision = !seleAllComision">
                                        <i class="fa" :class="(seleAllComision) ? 'fa-square-o' : 'fa-check-square'"></i>
                                    </button>
                                </th>
                                @endif
                                <th>ID Comision</th>
                                <th>Fecha</th>
                                <th>Concepto</th>
                                <th>ID Referido</th>
                                <!-- <th>Referido</th> -->
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in ComisionesDetalles.comisiones" class="text-center">
                                @if ($all)
                                <td>
                                    <input type="checkbox" :value="item.id" :checked="(seleAllComision) ? true : false" name="listComisiones[]">
                                </td>
                                @endif
                                <td v-text="item.id"></td>
                                <td v-text="item.fecha"></td>
                                <td v-text="item.descripcion"></td>
                                <td v-text="item.referred_id"></td>
                                <!-- <td v-text="item.referred_id.fullname"></td> -->
                                <td v-text="item.amount +' $'"></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-right">Total Comision</th>
                                <th colspan="2" v-text="ComisionesDetalles.total+' $'" class="text-right"></th>
                            </tr>
                        </tfoot>
                    </table>
                    @if ($all)
                    <div class="form-group text-center">
                        <button class="btn btn-primary">Pagar</button>
                    </div>
                    @endif
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>