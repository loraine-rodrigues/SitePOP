<?php

if (isset($_SESSION['logado']) && $_SESSION['tipo'] == 3) {
    $_SESSION['adm'] = TRUE;
}
else {
    $_SESSION['adm'] = FALSE;
}