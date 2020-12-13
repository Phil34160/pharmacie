<?php
    
    class Pharm{
    // METHODE AJOUT CLIENT

        public function setClient($a,$b){
            include 'db_pharm.php';
            if($this->lireClient($a)===false){
                echo "Client deja existant !";
                header('Refresh:3;url=pharm.php');
            } else {
            try{
                $sth = $dbco->prepare("
                    INSERT INTO Client (name_client, credit) VALUES ("."'$a'".","."'$b'".")
                ");
                if($sth->execute()){
                    echo "Nouveau client ajouté !";
                } else {
                    echo "Erreur dan vos variables !";
                }
                }
                catch (PDOException $e){
                    echo "Erreur : " . $e->getMessage();
                    }
                }
        }
    // METHODE AJOUT MEDICAMENT

        public function setMedicament($c,$d,$e){
            include 'db_pharm.php';
            if($this->lireMedicament($c)===false){
                echo"Médicament déjà existant";
                header('Refresh:3;url=pharm.php');
            } else {
                try{
                $sth = $dbco->prepare("
                    INSERT INTO Medicament (name_product, price, stock) VALUES ("."'$c'".","."'$d'".","."'$e'".")
                ");
                if($sth->execute()){
                    echo "Nouveau médicament ajouté !";
                } else {
                    echo "Erreurs dans vos variables !";
                }
                }
                catch (PDOException $e){
                    echo "Erreur : " . $e->getMessage();
                    }
                }
        }
    // METHODE AFFICHAGE BDD

        public function getAffichage(){
            include 'db_pharm.php';

            try{
            $sth = $dbco->prepare("
            SELECT name_client, credit FROM Client
        ");
            $sth1 = $dbco->prepare("
            SELECT name_product, price, stock FROM Medicament
        ");
            $sth->execute();
            $sth1->execute();
            echo "<table class='table1' border='1px'><thead><tr><th colspan='2'>Clients</th></tr><tr><th>Noms</th><th>Crédits</th></tr></thead>";
            while($result = $sth->fetch(PDO::FETCH_ASSOC)){
            echo "<tr><td>".$result["name_client"]."</td><td>".$result["credit"]."</td></tr>";
            }
            echo "</table>";
            echo "<table class='table2' border='1px'><thead><tr><th colspan='3'>Médicaments</th></tr><tr><th>Noms</th><th>Price</th><th>Stock</th></tr></thead>";
            while($result1 = $sth1->fetch(PDO::FETCH_ASSOC)){
            
            echo "<tr><td>".$result1["name_product"]."</td><td>".$result1["price"]."</td><td>".$result1["stock"]."</td></tr>";
            
            }
            echo "</table>";
         }
        catch (PDOException $e){
            echo "Erreur : " . $e->getMessage();
            }
        }
    // METHODE APPROVISIONNEMENT
    
        public function appro($n,$q){
            include 'db_pharm.php';
        if($this->lireMedicament($n)===false){
        try{
            $sth2=$dbco->prepare("
                UPDATE Medicament SET stock= (stock) + ("."$q".") WHERE name_product='"."$n"."'
            ");
            if($sth2->execute()){
            echo "Mise à jour du stock effectuée !";
            } else{
                echo "erreur dans vos variables !";
            }
        }
        catch (PDOException $e){
            echo "Erreur : " . $e->getMessage();
            }
        } else{
            echo "Ce médicament n'existe pas !";
            header('Refresh:3;url=pharm.php');
        }
        }
    // METHODE FILTRAGE NOM MEDICAMENT
    
        public function lireMedicament($c){
            include 'db_pharm.php';
            $test = 1;
            try{
                $sth2=$dbco->prepare("
                    SELECT name_product FROM Medicament
                ");
                $sth2->execute();
                while($result = $sth2->fetch(PDO::FETCH_ASSOC)){
                    if($result["name_product"] == $c){
                       $test = 0;
                    } 
                }
                if($test==0){
                    return false;
                    die();
                }
            }
            catch (PDOException $e){
                echo "Erreur : " . $e->getMessage();
                }
                return true;
            }
    // METHODE FILTRAGE NOM CLIENT 
    
        public function lireClient($a){
            include 'db_pharm.php';
            $test = 1;
            try{
                $sth2=$dbco->prepare("
                    SELECT name_client FROM Client
                ");
                $sth2->execute();
                while($result = $sth2->fetch(PDO::FETCH_ASSOC)){
                    if($result["name_client"] == $a){
                       $test = 0;
                    } 
                }
                if($test==0){
                    return false;
                    die();
                } 
            }
            catch (PDOException $e){
                echo "Erreur : " . $e->getMessage();
                }
            return true;
        }
    // METHODE ACHAT AVEC TEST NOM CLIENT ET MEDICAMENT VIA LA METHODE FILTRAGE 
        
        public function updateCredit($a,$b,$c,$d){
            include 'db_pharm.php';
        if($this->lireClient($a)===false AND $this->lireMedicament($b)===false){
        try{
            $sth2=$dbco->prepare("
                UPDATE Medicament SET stock=(stock) - ("."'$c'".") WHERE name_product="."'$b'"."
            ");
            
            $sth3=$dbco->prepare("
            UPDATE Client SET credit = ((credit) - (".$d.")) + ((SELECT price FROM `Medicament` WHERE name_product = '".$b."') * (".$c.")) WHERE name_client = '".$a."'
            ");
            if($sth3->execute() AND $sth2->execute()){
            echo "Vos crédits et votre stock sont mis à jour !";
            } else{
                echo "erreur dans vos variables !";
            }
        }
        catch (PDOException $e){
            echo "Erreur : " . $e->getMessage();
            }
        } else if ($this->lireClient($a)!=false AND $this->lireMedicament($b)!=false){
            
                echo"Ce client et ce médicament n'existent pas !";
                
                } else if($this->lireMedicament($b)!=false){
                    echo"Ce médicament n'existe pas !";
                    
                } else if($this->lireClient($a)!=false){
                    echo"Ce client n'existe pas !";
                }
        }
    }
?>