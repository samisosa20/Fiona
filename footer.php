<footer class="footer text-center text-muted">
    All Rights Reserved by Sammy Guttman.
</footer>
<script>
    function screen_home(){
        if ('serviceWorker' in navigator) {
            console.log("Will the service worker register?");
            navigator.serviceWorker.register('../service-worker.js')
            .then(function(reg){
                console.log("Yes, it did.");
            }).catch(function(err) {
                console.log("No it didn't. This happened:", err)
            });
        }
        $("#ModalScreen").modal("show");
    };
</script>
<div id="ModalScreen" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Añadir a tu pantalla principal</h4>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
            <button type="button" id="screen_android" class="btn btn-success col-12"
                   >Android</button>
            <button type="button" class="btn btn-primary col-12 mt-2"
                    id="screen_iphone">Iphone</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light"
                    data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="ModalScreenAndroid" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Añadir a tu android</h4>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
            Para agregar la aplicación web a tu home screen deberas realizar 3 simples pasos:<br>
            1. Dar clic en los 3 puntos verticales que se encuentra en la parte superior derecha 
            del navegador, como se muestra en la imagen.<br>
            <img src='../img/step_1.jpeg' alt='step_1' width='100%'>
            <br>
            2. Desplaza el menu hacia abajo y busca la opción Add To Home Screen o agregar a pantalla 
            principal, como se mustra en la imagen.<br>
            <img src='../img/step_2.jpeg' alt='step_2' width='100%'>
            <br>
            3. Por ultimo personaliza el nombre y dale clic en la opción Add o Añadir, como se muestra 
            en la imagen.<br>
            <img src='../img/step_final.jpeg' alt='step_final' width='100%'>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light"
                    data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="ModalScreenIOS" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Añadir a tu Iphone</h4>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
            Para agregar la aplicación web a tu home screen deberas realizar 3 simples pasos:<br>
            1. Dar clic en el icono compartir que se encuentra en la parte inferior 
            del navegador, como se muestra en la imagen.<br>
            <img src='../img/step_1_ios.jpeg' alt='step_1' width='100%'>
            <br>
            2. Desplaza el menu hacia abajo y busca la opción Add To Home Screen o agregar a pantalla 
            principal, como se mustra en la imagen.<br>
            <img src='../img/step_2_ios.jpeg' alt='step_2' width='100%'>
            <br>
            3. Por ultimo personaliza el nombre y dale clic en la opción Add o Añadir, como se muestra 
            en la imagen.<br>
            <img src='../img/step_3_ios.jpeg' alt='step_final' width='100%'>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light"
                    data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="ModalMensajes" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="ModalMensaLbl" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="ModalMensaLbl"></h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <div id="bodyMensajes" class="modal-body">
                            <div class="row mb-2">
                                <label for="catego_mensaje"
                                    class="col-sm-2 col-form-label text-dark">Categoria :</label>
                                <div class="col-sm-10">
                                    <label class="col-form-label"
                                        id="catego_mensaje"></label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="fecha_mensaje"
                                    class="col-sm-2 col-form-label text-dark">Fecha :</label>
                                <div class="col-sm-10">
                                    <label class="col-form-label"
                                        id="fecha_mensaje"></label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="contenido_mensaje"
                                    class="col-sm-2 col-form-label text-dark">Contenido :</label>
                                <div class="col-sm-10">
                                    <label class="col-form-label"
                                        id="contenido_mensaje"></label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light"
                            data-dismiss="modal"
                                aria-hidden="true">Salir</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->