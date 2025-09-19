<?php
namespace Src\Models;
use CoffeeCode\DataLayer\DataLayer;
class SlidesShows extends DataLayer
{
    public function __construct()
    {
        # parent::__construct("nome_da_tabela", ["campo1","campo2"...], "campo_id_da_tabela");
        parent::__construct("conciergeSlidesShows", [], "slideID");
    } // end function
}