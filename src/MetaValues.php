<?php

namespace Skynettechnologies\AllInOneAccessibility;

use Dryven\Faviconator\Faviconator;
use Skynettechnologies\Allinoneaccessibility\Blueprint\Formulus;
use Illuminate\Support\Collection;
use Statamic\Facades\File;
use Statamic\Facades\YAML;

class MetaValues {
    public const NAMESPACE = "skynettechnologies/all-in-one-accessibility";

    public const PATH_STYLESHEET = "vendor/" . self::NAMESPACE . "/css/";
    public const PATH_JAVASCRIPT = "vendor/" . self::NAMESPACE . "/js/";
    public const VENDOR_CUSTOM_RESOURCES_KEY = self::NAMESPACE . '-resources-custom';

  /**
   * @var array|Collection|null
   */
//  private $items;

  // public function __construct($items = null) {
  //   if (!is_null($items)) {
  //     $items = collect($items)->all();
  //   }
  //   $this->items = $items;
  // }
    // public static function getNamespacedKey($key): string
    // {
    //     return Faviconator::NAMESPACE . '::' . $key;
    // }

  // public static function make($items = null) {
  //   return new static($items);
  // }

  // public function augmented() {
  //   return Formulus::getBlueprint()::make()
  //     ->setContents(['fields' => MetaValues::make()->features()])
  //     ->fields()
  //     ->addValues($this->values())
  //     ->augment()
  //     ->values()
  //     ->all();
  // }

  // public function save() {
  //   File::put($this->path(), Yaml::dump($this->items));
  // }

  // public function values() {
  //   return Yaml::file($this->path())->parse();
  // }

  // private function path() {
  //   return base_path('addons/skynettechnologies/all-in-one-accessibility/content/default.yaml');
  // }
}
