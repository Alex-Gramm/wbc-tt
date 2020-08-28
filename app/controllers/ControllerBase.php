<?php
declare(strict_types=1);

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize(){

        // TODO Build assets before deploying

        // build sass
        $CssCollection = $this->assets->collection('css');
        $CssCollection
            ->setTargetPath('css/style.css')
            ->setTargetUri('css/style.css')
            ->addCss('sass/index.scss')
            ->join(true)
            ->addFilter(
                new Phalcon\Assets\Filters\Cssmin()
            );


        $CssCollection->addCss(
            'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css',
            false,
            true,
            [
                'integrity' => "sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO",
                'crossorigin' => "anonymous"
            ]
        );

        $jsCollection = $this->assets->collection('js');

        $jsCollection->addJs(
            'https://code.jquery.com/jquery-3.3.1.slim.min.js',
            false,
            true,
            [
                'integrity' => "sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo",
                'crossorigin' => "anonymous"
            ]
        );
        $jsCollection->addJs(
            'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js',
            false,
            true,
            [
                'integrity' => "sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49",
                'crossorigin' => "anonymous"
            ]
        );

        $jsCollection->addJs(
            'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js',
            false,
            true,
            [
                'integrity' => "sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy",
                'crossorigin' => "anonymous"
            ]
        );

        $jsCollection
            ->setTargetPath('js/app.js')
            ->setTargetUri('js/app.js')
            ->join(true)
            ->addFilter(
                new Phalcon\Assets\Filters\Jsmin()
            );

    }
}
