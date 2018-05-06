<?php
declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: username
 * Date: 05/01/2016
 * Time: 15:57
 */
namespace Myhelper;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver;
use Zend\Console\Exception;

abstract class Template{

    /**
     * @param $_UrlScript : chemin de Base dans le quel les fichier de view a inseret dans l'interface
     * @param $file : fichier HTML de view
     * @param array $tableassigne : table des variable a inseret dans l'interface
     * @return string : document HTML de view a mettre dans l'interface
     *
     * Mini fonction quipermet de charger le HTML g�n�rique (template)
     *
     * ecc
     */
    public static function GenView($templatename,$template_map,$tableassigne=array()){

            $html = new ViewModel($tableassigne);


            $html->setTemplate($templatename);


            $renderer = new PhpRenderer();

            $resolver = new Resolver\AggregateResolver();

            $map = new Resolver\TemplateMapResolver(include $template_map);
            $stack = new Resolver\TemplatePathStack(array(
                "layouts/adminlte",
            ));
            $resolver->attach($map)    // this will be consulted first
            ->attach($stack);
            $renderer->setResolver($resolver);
            return $renderer->render($html);




    }




}