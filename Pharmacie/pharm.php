<?php
    require 'classes/pharm.class.php';
    require 'classes/client.class.php';
    require 'classes/medicament.class.php';
    require 'db_pharm.php';
?>
<html>
    <head>
        <meta charset="utf-8">
        <style>
            html,body{
                margin: 0;
                padding: 0;
                height: 100vh;
                background: center no-repeat url('pharmacie.jpg');
                background-size: 40%;
                
            }
            .input_choice{
                width: 5%;
                margin-left: 1.5%;
            }
            .table1,.table2{
                display: inline-block;
                margin-left: 1.5%;
                
                box-shadow: 5px 6px 5px green;
            }
            .table1 th,.table2 th{
                background: silver;
            }
        </style>
    </head>
    <body>
    <h1 align="center">Gestion pharmacie</h1>
    
    <ol>
        <li>Ajouter client</li>
        <li>Ajouter Médicament</li>
        <li>Affichage client et stock</li>
        <li>Approvisionnement</li>
        <li>Achat</li>
        <li>Quitter</li>
    </ol>
    <form method="GET" action="">
        <label for="choix">&emsp; Entrez votre choix :</label><br><br>
        <input type="number" class="input_choice" min="1" max="6" name="choix" id="choix">
        <input type="submit" name="valider" id="valider">
    </form>
    
<?php
    // TEST FORMULAIRE DE CHOIX
    $phil = new Pharm();
    if(isset($_GET['valider'])){
    $choice = $_GET['choix'];
    
    // CHOIX USER

    //APPARATION FORMULAIRE AJOUT CLIENT
        if($choice==1){
            ?> 
              <form method="POST" action="">
                  <label>Entrez nouveu client :</label>
                  <input placeholder="Nom du client" type="text" name="nomC">
                  <input placeholder="Credit client" type="number" name="credit">
                  <input type="submit" name="validClient">
                </form>
              <?php
        }
    //APPARATION FORMULAIRE AJOUT MEDICAMENT

        else if($choice==2){
            ?> 
              <form method="POST" action="">
                  <label>Entrez nouveu médicament :</label>
                  <input placeholder="Nom du médicament" type="text" name="nomM">
                  <input placeholder="prix du médicament" type="float" name="prix">
                  <input placeholder="Quantité stock" type="number" name="qteS">
                  <input type="submit" name="validMedicament">
                </form>
              <?php
        }
    // AFFICHAGE BDD
        else if($choice==3){
             
                $phil->getAffichage();
            
    // APPARITION FORMULAIRE APPROVISIONNEMENT
        } else if($choice==4){
              //$phil->inputAppro();
              ?> 
              <form method="POST" action="">
                  <label>Entrez vos modifs :</label>
                  <input placeholder="Nom du medicament" type="text" name="nom">
                  <input placeholder="Quantité" type="number" name="qte">
                  <input type="submit" name="validAppro">
                </form>
              <?php
             
    // APPARATION FORMULAIRE ACHAT        
                
        } else if($choice==5){
            
            ?> 
            <form method="POST" action="">
                <label>Selectionnez votre achat :</label>
                <input placeholder="nom client" type="text" name="nomClient">
                <input placeholder="nom medicament" type="text" name="nomMedoc">
                <input placeholder="quantité" type="number" name="qte">
                <input placeholder="vos fonds dispo" type="number" name="montant">
                <input type="submit" name="validAchat">
              </form>
            <?php
    
    // QUITTER

        }else if($choice==6){
                echo "&emsp;Programme terminé !";
                header('Refresh: 3;url=pharm.php');
                
            }
        }
    // TEST FORMULAIRE AJOUT CLIENT + METHODE SETCLIENT()
        if(isset($_POST["validClient"])){
            $phil->setClient($_POST["nomC"],$_POST["credit"]);
        }

    // TEST FORMULAIRE AJOUT MEDICAMENT + METHODE SETMEDICAMENT()

        if(isset($_POST["validMedicament"])){
            $phil->setMedicament($_POST["nomM"],$_POST["prix"],$_POST["qteS"]);
            //$phil->setMedicament($_POST["nomM"],$_POST["prix"],$_POST["qteS"]);
        }

    // TEST FORMULAIRE APPRO + METHODE APPRO QUI UPDATE LA BDD

        if(isset($_POST["validAppro"])){
            //$n = $_POST["nom"]; 
            //echo "hello".$n;
        $phil->appro($_POST["nom"],$_POST["qte"]);
    }  
    
    // TEST FORMULAIRE ACHAT + METHODE UPDATECREDIT()

        if(isset($_POST["validAchat"])){
        
        $phil->updateCredit($_POST["nomClient"],$_POST["nomMedoc"],$_POST["qte"],$_POST["montant"]);   

         
}     
?>
    </body>
</html>
