<?php
class Login{

    function mostrarAdmin(){ ?>
        <div id="continer-inicio-admin">
            <section id="login">
                <header class="cabecera">
                    <h2 class="titulo">Login</h2>
                </header>
                <div class="cuerpo">
                    <form id="floginAdmin" method="post" action="/dailysport/administracion/index.php">
                        <ul>
                            <li class="linea">
                                <input type="email" id="uname" name="uname" placeholder="email...">
                            </li>
                            <li class="linea">
                                <input type="password" id="pass" name="pass" placeholder="contraseña...">
                            </li>
                        </ul>
                        <input class="anim-g" type="submit" value="entrar">
                    </form>
                </div>
            </section>
        </div>
<?php    
    }

}

?>