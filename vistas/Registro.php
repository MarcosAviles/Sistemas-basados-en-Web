<?php
class Registro{
    function Registro(){

    }

    function mostrar(){
        ?>

        <div id="continer-inicio">
            <section id="login">
                <header class="cabecera">
                    <h2 class="titulo">Login</h2>
                </header>
                <div class="cuerpo">
                    <form id="flogin" method="post" action="index.php">
                        <ul>
                            <li class="linea">
                                <input type="text" id="uname" name="uname" placeholder="username">
                            </li>
                            <li class="linea">
                                <input type="password" id="pass" name="pass" placeholder="contraseña">
                            </li>
                        </ul>
                        <input class="anim-g" type="submit" value="entrar">
                    </form>
                </div>
            </section>
            <section id="registro">
                <header class="cabecera">
                    <h2 class="titulo">Registro</h2>
                    <div class="adaptar-img anim-g" id="cerrar-registro"></div>
                </header>
                <div class="cuerpo">
                    <form id="fregistro" method="post" action="index.php">
                        <ul>
                            <li class="linea">
                                <input type="text" id="nombre" name="nombre" placeholder="nombre...">
                            </li>
                            <li class="linea">
                                <input type="text" id="apellidos" name="apellidos" placeholder="apellidos...">
                            </li>
                            <li class="linea">
                                <input type="email" id="email" name="email" placeholder="email...">
                            </li>
                            <li class="linea">
                                <input type="date" id="fnac" name="fnac" placeholder="fecha de nacimiento...">
                            </li>
                            <li class="linea">
                                <input type="text" id="nick" name="nick" placeholder="username...">
                            </li>
                            <li class="linea">
                                <input type="password" id="rpass" name="rpass" placeholder="contraseña...">
                            </li>
                            <li class="linea">
                                <input type="password" id="rpassc" name="rpassc" placeholder="confirmar contraseña">
                            </li>
                        </ul>
                        <input class="anim-g" type="submit" value="registrar">
                    </form>
                </div>
            </section>
        </div>
        <?php
    }
}
?>