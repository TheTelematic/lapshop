<div class="contenidoSection">
    <h2 class="tituloSection">
        Registro
    </h2>
    <div class="login">
        
            <?php echo validation_errors();?>
        <form style="border: double;" id="formulario" method="POST" action="<?php echo base_url(); ?>index.php/Login/registro">
            <table>
                <tbody>
                    <tr>
                        <td>Nombre: </td>
                        <td><input type="text" name="usr_nombre" id="nombre" size="30" title="Nombre"></td>
                        
                    </tr>
                    <tr>
                        <td>Apellido: </td>
                        <td colspan="5"><input type="text" name="usr_apellido" id="apellido" size="70" title="Apellido"></td>
                    </tr>
                    <tr>
                        <td>Calle y numero: </td>
                        <td colspan="5"><input type="text" name="usr_direccion" id="direccion" size="70" title="Direccion"></td>
                    </tr>
                    <tr>
                        <td>Codigo postal: </td>
                        <td colspan="5"><input type="number" name="usr_cp" id="cpostal" title="Codigo postal"></td><td><span id="error_cp" hidden>Debe tener 5 digitos</span>
                    </tr>
                    <tr>
                        <td>
                            Ciudad:</td>
                        <td><input type="text" name="usr_ciudad" id="ciudad" size="30" title="Ciudad"></td>
                    </tr>
                    
                    <tr>
                        <td>Contraseña: </td>
                        <td colspan="5"><input type="password" id="contr" name="pass"></td><td><span id="error_new_pass" hidden>La contraseña debe tener al menos 6 caracteres, incluyendo un signo de puntuación, un numero y mayusculas</span></td>
                    </tr>
                    <tr>
                        <td>Confirme la contraseña: </td>
                        <td colspan="5"><input type="password" id="contr2"><span id="pass_not_matched" hidden>No coincide</span></td>
                        
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td colspan="5"><input type="email" id="email_registro" name="usr_email"></td><td><span id="error_email" hidden>Debe tener @ y un punto.</span></td>
                    </tr>
                    <tr>
                        <td>Pulse aquí:</td>
                        <td></td>
                        <td><input type="submit" value="Enviar datos" id="enviar"></td>
                        <td><input type="reset" value="Borrar los datos"></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <script type="text/javascript" src="<?php echo base_url();?>js/registro.js"></script>
    </div>
</div>