<div class="row" style="margin-top: 1rem; margin-left: 2rem; margin-bottom: 0px">
    <div class="col m1">

        <ul id="slide-out" class="sidenav collapsible">
            <li>
                <div class="user-view">
                    <div class="background">
                        <img src="img/21402.jpg">
                    </div>
                    <a href="#"><img class="circle white" style="height: 6rem; width: 6rem; padding: 4px" src="img/logo.png"></a>
                    <a href="#"><span class="white-text name"> Jacqueline Sanchez maniu</span></a>
                    <a href="#"><span class="white-text email">jsanchez@itshopelchen.edu.mx</span></a>

                    <form class="center-align" action='../servidor/logout.php'>
                        <button style="margin:0" class="teal darken-3 waves-effect waves-light btn">Cerrar Sesión</button>
                    </form>
                </div>
            </li>
            <li><a href="index.php">Residentes</a></li>
            <li> <a class="modal-trigger" href="#modalResidentes">Añadir Residente</a></li>
            <li> <a href="indicadorResidentes.php">Ver Indicador de residentes</a></li>
            <li>
                <div class="divider">
            <li><a href="convenios.php">Convenios</a></li>
            <li><a class="modal-trigger" href="#CONVENIOS">añadir Convenios</a></li>
            <li> <a href="indicadorConvenios.php">Ver Indicador de convenios</a></li>
            <li> <a href="empresas.php">Empresas</a></li>
            <li> <a href="asesores.php">Asesores</a></li>
            <li>
                <div class="divider">
            <li><a href="promocion.php">Promoción</a></li>
            <li> <a href="grafics.php">Ver gráficos</a></li>



        </ul>

        <a href="#" data-target="slide-out" class="sidenav-trigger"> <img src="img/logo.png" class="responsive-img"></a>
    </div>

    <div class="col m10">
        <nav class="teal darken-1" style="border-radius: 30px; margin-left:30px; height: 60px; margin-top: 15px; width: 73rem;">
            <div class="nav-wrapper ">
                <form action="" id='buscarAll'>
                    <div class="input-field">
                        <input class="teal darken-1" id="buscar" type="search" required style="border-radius: 30px; color: white; font-size: 18px" name="buscar">
                        <label for=" buscar" class="label-icon">
                            <i class="material-icons white-text">search</i>
                        </label>
                        <i class="material-icons">close</i>
                    </div>
                </form>
            </div>
        </nav>
    </div>


</div>

<!---------------------------------------------------------------->

<div id="modalResidentes" class="modal">
    <div class="row">
        <form class="col m12" id="INSERTAR_RESIDENCIA">
            <div class="row modal-content">
                <h4>Residente</h4>
                <div class="input-field col m2">
                    <input name="MATRICULA" type="text" class="validate" onblur="verificarMatricula(this)">
                    <label for="MATRICULA">Matrícula</label>
                </div>

                <div class="input-field col m6">
                    <input name="NOMBRE" disabled value="Residente Seleccionado" id="nombre" type="text" class="validate">

                </div>

                <div class="input-field col m4">
                    <select name="ASESOR_EXTERNO">
                        <option value="0" disabled selected>Asesor externo</option>
                        <?php
                        require_once "../servidor/modulos/asesoresExternos.php";
                        $aE = new AsesorExterno();
                        $aE->selectAsesoresExt();
                        ?>

                    </select>
                    <label for="ASESOR_EXTERNO">Seleccione el asesor externo</label>
                </div>


                <div class="input-field col m4">
                    <select name="ASESOR_INTERNO" ID="ASESOR_INTERNO">
                        <option value="0" disabled selected>Asesor Interno</option>
                        <?php
                        require_once "../servidor/modulos/asesoresInternos.php";
                        $aI = new AsesorInterno();
                        $aI->selectAsesoresInt();
                        ?>
                    </select>
                    <label for="ASESOR_INTERNO">Seleccione el asesor interno</label>
                </div>


                <div class="input-field col m4">
                    <select name="EMPRESA">
                        <option value="0" disabled selected>Empresa</option>

                        <?php
                        require_once "../servidor/modulos/empresas.php";
                        $empresa = new Empresa();
                        $empresa->selectEmpresa();
                        ?>

                    </select>
                    <label for="EMPRESA ">Seleccione la empresa</label>
                </div>

                <div class="input-field col m4">
                    <input name="CALIFICACION" type="number" class="validate" step="0.1">
                    <label for="CALIFICACION">Calificación</label>
                </div>

                <div class="input-field col m6 ">
                    <input name="PROYECTO" type="text" class="validate">
                    <label for="PROYECTO"> Nombre de proyecto</label>
                </div>

                <div class="col m3">
                    <input type="text" name="INICIO_RESIDENCIA" class="datepicker">
                    <label for="fINICIO_RESIDENCIA" class="">Fecha de Inicio </label>
                </div>

                <div class="col m3">
                    <input name="FIN_RESIDENCIA" type="text" class="datepicker">
                    <label for="FIN_RESIDENCIA" class="">Fecha de Fin</label>
                </div>

               <!-- <div class="input-field col m2">
                    <select name="ESTADO">
                        <option value="0" disabled selected>Estado</option>
                        <option value="ACTIVO">Activo</option>
                        <option value="BAJA">Baja</option>
                    </select>

                </div>

----->


            </div>

            <div class="modal-footer">
                <button type="submit" href="" class="modal-close waves-effect waves-green btn-flat">Añadir</button>
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
            </div>
    </div>
    </form>


</div>
</div>

<!-------  ---------------------------->

<div id="CONVENIOS" class="modal" style="width: 600px" ;>
    <div class="row">
        <form id="INSERTAR_CONVENIO">
            <div class="row modal-content">
                <h4>Añadir convenio</h4>
                <div class="input-fieldv col m10">
                    <select name="ID_EMPRESA">
                        <option value="0" disabled selected>Empresa</option>
                        <?php
                        require_once "../servidor/modulos/empresas.php";
                        $empresa = new Empresa();
                        $empresa->selectEmpresa();
                        ?>
                    </select>
                    <label for="ID_EMPRESA">Seleccione la empresa</label>
                </div>


                <div class="col m6 push">
                    <input name="FECHA_INICIO" type="text" class="datepicker">
                    <label for="FECHA_INICIO" class="">Inicio de convenio </label>
                </div>

                <div class="col m6">
                    <input name="FECHA_FIN" type="text" class="datepicker">
                    <label for="FECHA_FIN" class=""> Fin de convenio </label>
                </div>


                <div class="input-field col m12">
                    <select name="TIPO_CONVENIO">
                        <option value="0" disabled selected>Tipo de convenio</option>
                        <?php
                        require_once "../servidor/modulos/convenios.php";
                        $convenioCat = new Convenio();
                        $convenioCat->selectCategoria();


                        ?>

                    </select>

                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" name="add" href="" class="modal-close waves-effect waves-green btn-flat">Añadir</button>
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
            </div>
    </div>
    </form>
</div>
</div>


<script type="text/javascript" src="js/insertarResidencia.js"></script>
<script type="text/javascript" src="js/insertarConvenio.js"></script>
<script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>
<script>
    function verificarMatricula(inp) {
        $.ajax({
            data: {
                matricula: inp.value
            },
            url: '../administrador/ajax/verificar_matricula.php',
            type: '',
            succesposts: function(data) {
                console.log(data);
                $('#nombre').val(data);

            }
        });



    }
</script>