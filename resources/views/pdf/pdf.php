
<?php

//pdf.php

// require_once 'dompdf/autoload.inc.php';
// require 'vendor/autoload.php';
// require_once 'dompdf/lib/html5lib/Parser.php';
// require_once 'dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
// require_once 'dompdf/lib/php-svg-lib/src/autoload.php';
// DOMPDF
require_once 'dompdf/src/Autoloader.php';
use Dompdf\Dompdf;

class Pdf extends Dompdf{

 public function __construct(){
  parent::__construct();
 }
}

?>