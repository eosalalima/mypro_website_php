<?php
declare(strict_types=1);
namespace MyPro;
final class View
{
    public static function render(string $template,array $data=[],string $layout='layouts/public'): void
    {
        extract($data, EXTR_SKIP);
        ob_start();
        require dirname(__DIR__).'/views/'.$template.'.php';
        $content=ob_get_clean();
        ob_start();
        require dirname(__DIR__).'/views/'.$layout.'.php';
        $html=ob_get_clean();
        $base=app_base_path();
        if ($base !== '') $html=preg_replace_callback('/\b(href|src|action)="\/(?!\/)/',static fn(array $match): string=>$match[1].'="'.e($base).'/', $html) ?? $html;
        echo $html;
    }
}
