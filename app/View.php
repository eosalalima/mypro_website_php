<?php
declare(strict_types=1);
namespace MyPro;
final class View
{
    public static function render(string $template,array $data=[],string $layout='layouts/public'): void
    {
        extract($data, EXTR_SKIP); ob_start(); require dirname(__DIR__).'/views/'.$template.'.php'; $content=ob_get_clean(); require dirname(__DIR__).'/views/'.$layout.'.php';
    }
}
