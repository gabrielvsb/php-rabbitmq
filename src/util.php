<?php
function limparTerminal() {
    if (strncasecmp(PHP_OS, 'WIN', 3) === 0) {
        system('cls');
    } else {
        system('clear');
    }
}