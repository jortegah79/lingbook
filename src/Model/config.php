<?php

namespace App\Model;
define("LOCAL",true);

if(LOCAL){

define("USER",'root');
define("PASS",'root');
define("HOSTNAME","localhost");
define("DATABASE","lingbook");

}else{

define("USER","mylingbookad");
define("PASS","sdUc38xc");
define("HOSTNAME","localhost");
define("DATABASE","lingbook");
}

define("CHARSET","utf-8");
define("UN_DIA",60*60*24);
