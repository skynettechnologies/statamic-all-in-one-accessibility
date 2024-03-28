<?php
namespace Skynettechnologies\AllInOneAccessibility\Tags;
//use Skynettechnologies\AllInOneAccessibility\Utils\Box;
use Statamic\Tags\Tags;

class AllInOneAccessibility extends Tags
{
    protected $config;
    /**
     * The {{ all_in_one_accessibility }} tag.
     *
     * @return string|array
     */
    public function index()
    {
       return $this->getJavaScriptVariable();
    }

   protected function getJavaScriptVariable()
   {
       return '<script id="aioa-adawidget" src="https://www.skynettechnologies.com/accessibility/js/all-in-one-accessibility-js-widget-minify.js?aioa_reg_req=true&colorcode=#420083&token=&position=bottom_right"></script>';
   }
}
