<?php

class ParroquiaTable extends Doctrine_Table
{
  public static function retrieveBackendParroquiaList(Doctrine_Query $q) {
    $rootAlias = $q->getRootAlias();
    $q->leftJoin($rootAlias.'.Arciprestazgo arciprestazgo')
      ->leftJoin('arciprestazgo.Vicaria vicaria')
      ->leftJoin('vicaria.Diocesis diocesis');
    return $q;
  }

}
