<?php

$lunettes = $_POST['lunettes'];
$moustache = $_POST['moustache'];
$chapeau = $_POST['chapeau'];
$cheveux = $_POST['cheveux'];
$boucleoreille = $_POST['boucleoreille'];
$barbe = $_POST['barbe'];
$noeudpapillon = $_POST['noeudpapillon'];


$s1=($lunettes + $chapeau + $boucleoreille + $noeudpapillon) % 2;
$s2=($moustache + $chapeau + $boucleoreille + $barbe) % 2;
$s3=($cheveux + $boucleoreille + $barbe + $noeudpapillon) % 2;

$mensonge=0;



if (isset($_POST['lunettes']) AND isset($_POST['moustache']) AND isset($_POST['chapeau']) AND isset($_POST['cheveux']) AND isset($_POST['boucleoreille']) AND isset($_POST['barbe']) AND isset($_POST['noeudpapillon'])){

    /* Syndrome 1 */
    
    if ($s1 == 1 && $s2 == 0 && $s3 == 0 ){
        if($lunettes == 1){
            $lunettes = 0;
        }
        else{
            $lunettes = 1;
        }
        $mensonge=1;
        echo("Vous avez menti à la question " . $mensonge . ". ");
    }
    
    
    /* Syndrome 2 */
    
    if ($s1 == 0 && $s2 == 1 && $s3 == 0 ){
        if($moustache == 1){
            $moustache = 0;
        }
        else{
            $moustache = 1;
        }
        $mensonge=2;
        echo("Vous avez menti à la question " . $mensonge . ". ");
    }
    
    /* Syndrome 3 */
    
    if ($s1 == 1 && $s2 == 1 && $s3 == 0 ){
        if($chapeau == 1){
            $chapeau = 0;
        }
        else{
            $chapeau = 1;
        }
        $mensonge=3;
        echo("Vous avez menti à la question " . $mensonge . ". ");
    }
    
    /* Syndrome 4 */
    
    if ($s1 == 0 && $s2 == 0 && $s3 == 1 ){
        if($cheveux == 1){
            $cheveux = 0;
        }
        else{
            $cheveux = 1;
        }
        $mensonge=4;
        echo("Vous avez menti à la question " . $mensonge . ". ");
    }
    
    /* Syndrome 5 */
    
    if ($s1 == 1 && $s2 == 1 && $s3 == 1 ){
        if($boucleoreille == 1){
            $boucleoreille = 0;
        }
        else{
            $boucleoreille = 1;
        }
        $mensonge=5;
        echo("Vous avez menti à la question " . $mensonge . ". ");
    }
    
    /* Syndrome 6 */
    
    if ($s1 == 0 && $s2 == 1 && $s3 == 1 ){
        if($barbe == 1){
            $barbe = 0;
        }
        else{
            $barbe = 1;
        }
        $mensonge=6;
        echo("Vous avez menti à la question " . $mensonge . ". ");
    }
    
    /* Syndrome 7 */
    
    if ($s1 == 1 && $s2 == 0 && $s3 == 1 ){
        if($noeudpapillon == 1){
            $noeudpapillon = 0;
        }
        else{
            $noeudpapillon = 1;
        }
        $mensonge=7;
        echo("Vous avez menti à la question " . $mensonge . ". ");
    }

$resultat= (1000000 * $lunettes) + (100000 * $moustache) + (10000 * $chapeau) + (1000 * $cheveux) + (100 * $boucleoreille) + (10* $barbe) + (1* $noeudpapillon);
    
echo("Vous avez choisi ce personnage :"."<BR>");
echo("<img src='$resultat.jpg'>");

}


else {
    echo("Erreur : Veuillez remplir tous les champs");
}

?> 