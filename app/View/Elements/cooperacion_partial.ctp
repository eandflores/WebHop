<div class='modal hide fade' id='coperacion'>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>¡Coopera con nosotros!</h3>
    </div>
    <div class="modal-body">
        <div id="tipoOperacion">
            <label>Escoja Una Opción</label>
            <div class='controls'>
                <a href="#" data-accion="nuevo" class='btn btn-success span3'>Nuevo Local</a>
                <span class='help-block'>Cooperanos indicándonos un nuevo Local</span>
                <a href="#" data-accion="agrega" class='btn btn-primary span3'>Nuevos Productos</a>
                <span class='help-block'>Cooperanos contándonos que productos comercializan los locales</span>
            </div>
        </div>
        <div id='nuevoLocal' style="display:none">
            <form class='form-horizontal' enctype="multipart/form-data" action='guarda_sugerido.php' method="post">
                <div class='control-group'>
                    <label class='control-label' for='nombre'>Nombre</label>
                    <div class='controls'>
                        <input type='text' name='nombre' id='nombre' placeholder="Nombre Local" required>
                    </div>
                </div>
                <div class='control-group'>
                    <label class='control-label' for='razon_social'>Razón Social</label>
                    <div class='controls'>
                        <input type='text' id="razon_socal" name='razon_social' placeholder="Razon Social" required>
                    </div>
                </div>
                <div class='control-group'>
                    <label class='control-label' for="calle">Calle</label>
                    <div class='controls'>
                        <input type='text' id='calle' name='calle' placeholder="Calle" required>
                    </div>
                </div>
                <div class='control-group'>
                    <label class='control-label' for='numero'>Número</label>
                    <div class='controls'>
                        <input type='text' id='numero' name='numero' placeholder='Numero' required>
                    </div>
                </div>
                <div class='control-group'> 
                    <label class='control-label' for='ciudad'>Ciudad</label>
                    <div class='controls'>
                        <input type='text' id='ciudad' name='ciudad' placeholder='Ciudad' required>
                    </div>
                </div>
                <div class='control-group'>
                    <label class='control-label' for='telefono'>Teléfono</label>
                    <div class='controls'>
                        <input type='text' id='telefono' name='telefono' placeholder="Telefono" required>
                    </div>
                </div>
                <div class='control-group'>
                    <label class='control-label' for="email">Email</label>
                    <div class='controls'>
                        <input type='text' id='email' name='email' placeholder="Email" required>
                    </div>
                </div>
                <div class='control-group'>
                    <label class='control-label' for="web">Sitio Web</label>
                    <div class='controls'>
                        <input type="text" id="web" name="web" placeholder="Pagina Web" required>
                    </div>
                </div>
                <div class='control-group'>
                    <label class='control-label' for="foto">Imagen</label>
                    <div class='controls'>
                        <input type='file' id='foto' name='foto' required>
                    </div>
                </div>
                <div class="control-group">
                    <label class='control-label' for='giro'>Giro</label>
                    <div class='controls'>
                        <input type="text" id='giro' name='giro' required>
                    </div>
                </div>
                <div class='control-group'>
                    <label class='control-label' for='productos'>Productos</label>
                    <div class='controls'>
                        <input type="text" id='productos' name='productos' required>
                        <span class='help-box'><br>Separados por comas Ejemplo: pan,café,etc</span>
                    </div>
                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-primary">Enviar</button>
                     <a href="#" class="btn" data-dismiss='modal'>Cerrar</a>
                </div>
        
             </form>
        </div>
        <div id='agregaProductos' style="display:none">
            <?php
                 $link = new DataBase();
                 $resource =  $link->select_query("SELECT id_local,nombre FROM local ORDER BY nombre ASC;");
            ?>
            <div class='row'>
                <div class='span3'>
                    <form action='clienteActualiza.php' method='post'>
                        <div class='control-group'>
                            <label for='idLocal'>Escoge un Local a Actualizar: </label>
                            <div class='controls'>
                                <select id='idLocal' name='idLocal'>
                                   <option value="-1" checked='checked'>---</option>
                                       <?php
                                           foreach ($resource as $key => $value) {
                                                printf("<option value='%d'>%s</option>\n",$value->id_local,$value->nombre);
                                            }
                                        ?>
                                </select>                           
                            </div>
                        </div>
                        <div class='control-group' id='nuevosProductos' style="display:none">
                            <label for="nuevos">Ingresa los nuevos Productos</label>
                            <div class='controls'>
                                 <input placeholder="Productos" id='nuevos' name='nuevosProductos' type='text' required/>
                                <br><span class='help-blocl'>Separados por comas Ejemplo: pan,café,etc</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                            <a href="#" class="btn" data-dismiss='modal'>Cerrar</a>
                        </div>
                    </form>
                </div>
                <div class='span3'>
                    <div id='listaProductosLocal'>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>