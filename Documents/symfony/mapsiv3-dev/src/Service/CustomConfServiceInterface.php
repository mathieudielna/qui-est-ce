<?php
namespace AppBundle\Service;

use Symfony\Component\Filesystem\Filesystem;

class CustomService
{
   public function getConf($extra = []) {
   	$customer = $extra['customer'];
   	$entity = $extra['bigentity'];
	    $folder = '../public/Documents/'.$customer.'/'.$entity;
        $fs = new Filesystem();
        if (!$fs->exists($folder)) {
            $fs->mkdir($folder);
        }
        return ['dir' => $folder];
   }
}
class CustomEntry
{
   public function getConf($extra = []) {
   	$customer = $extra['customer'];
   	$entity = $extra['bigentity'];
   	$entryprefix = $extra['entryprefix'];
   	$entryid = $extra['entryid'];
    $entryname = $extra['entryname'];
    $customername = $extra['customername'];
	    $folder = '../public/Documents/'.$customer.' - '.$customername.'/'.$entity.'/'.$entryprefix.'-'.$entryid.' '.$entryname;
        $fs = new Filesystem();
        if (!$fs->exists($folder)) {
            $fs->mkdir($folder);
        }
        return ['dir' => $folder];
   
   }
}

class CustomGlobal
{
   public function getConf($extra = []) {
   	$customer = $extra['customer'];
    $customername = $extra['customername'];
	    $folder = '../public/Documents/'.$customer.' - '.$customername;
        $fs = new Filesystem();
        if (!$fs->exists($folder)) {
            $fs->mkdir($folder);
        }
        return ['dir' => $folder];
   
   }
}