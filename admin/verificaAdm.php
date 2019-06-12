<?php

if (isset($_SESSION['logado']) && $_SESSION['tipo'] == 3) {
    $_SESSION['admin'] = TRUE;
}
else {
    $_SESSION['admin'] = FALSE;
}