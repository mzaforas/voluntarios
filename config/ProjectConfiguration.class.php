<?php
ini_set('memory_limit', '2200M');
//require_once '/home/mzaforas/Escritorio/symfony-1.4.1/lib/autoload/sfCoreAutoload.class.php';
//require_once '/usr/share/php/symfony/autoload/sfCoreAutoload.class.php';
require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('sfDoctrineGuardPlugin');
    $this->enablePlugins('sfJqueryReloadedPlugin');
    $this->enablePlugins('sfFormExtraPlugin');
    $this->enablePlugins('sfDoctrineActAsTaggablePlugin');
    $this->enablePlugins('sfiCalCreatorPlugin');
    $this->enablePlugins('sfJSLibTinyMCEPlugin');
  }


  public function configureDoctrine(Doctrine_Manager $manager)
  {
    $manager->setAttribute(Doctrine_Core::ATTR_USE_DQL_CALLBACKS, true);
  }
}
