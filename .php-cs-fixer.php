<?php

return (
    new PhpCsFixer\Config())->setRules([
            'braces' => array(
            'allow_single_line_closure' => true,
            'position_after_functions_and_oop_constructs' => 'same',
        )]);
