<?php
    require '../config/connexionBDD.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/auth.css">
</head>
<body>
    <section class="signup">
        <div class="left">
            <h1><span>I</span>nscription</h1>
            <img src="../images/inscipt.png" alt="">
        </div>

        <div class="rigth">
            <form action="" method="post">
                 <div class="formItem">
                    <label for="nom">Nom</label><br>
                    <input type="text" placeholder="Entrez votre nom" name="nom">
                    
                </div>
                 <div class="formItem">
                    <label for="prenom">Prénom</label><br>
                    <input type="text" placeholder="Entrez votre prénom" name="prenom">
                    
                </div>
                 <div class="formItem">
                    <label for="email">Email</label><br>
                    <input type="text" placeholder="Entrez votre email" name="email">
                    
                </div>
                 <div class="formItem">
                    <label for="password">Mot de passe</label><br>
                    <input type="password" placeholder="Créez un mot de passe" name="mdp" required>
                </div>
                <div class="formItem">
                    <label for="Confpassword">Confirmez le mot de passe</label><br>
                    <input type="password" placeholder="Confirmez le mot de passe" name="Cmdp" required>
                </div>
                
                <input type="submit" class="bouton" value="S'inscrire" name="inscrire">
                <h5 class="signOrLog">Déjà un compte ? <a href="connexion.php">Connectez-vous</a></h5>

                <?php
                    if(isset($_POST["inscrire"])){
                        $email = trim($_POST["email"]);
                        $nom = trim($_POST["nom"]);
                        $prenom = trim($_POST["prenom"]);
                        $mdp = $_POST["mdp"];
                        $Cmdp = $_POST["Cmdp"];

                        // Validation des champs
                        if(empty($email) || empty($nom) || empty($prenom) || empty($mdp) || empty($Cmdp)){
                            echo '<p style="color:red;">Veuillez remplir tous les champs.</p>';
                        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            echo '<p style="color:red;">Email invalide.</p>';
                        } elseif($mdp !== $Cmdp){
                            echo '<p style="color:red;">Les mots de passe ne correspondent pas.</p>';
                        } else {
                            // Vérifier si l'email existe déjà
                            $check = $pdo->prepare("SELECT COUNT(*) FROM utilisateurs WHERE email = ?");
                            $check->execute([$email]);
                            if($check->fetchColumn() > 0){
                                echo '<p style="color:red;">Cet email est déjà utilisé.</p>';
                            } else {
                                // Hash du mot de passe
                                $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);
                                try{
                                    $req = $pdo->prepare("INSERT INTO utilisateurs(nom,prenom,email,mdp) VALUES(?, ?, ?, ?)");
                                    $req->execute(array($nom, $prenom, $email, $mdp_hash));
                                    echo '<p style="color:green;">Inscription réussie !</p>';

                                    echo '<script>window.location.href="produits.php"</script>';
                                }catch(PDOException $e){
                                    echo '<p style="color:red;">Erreur : ' . $e->getMessage() . '</p>';
                                }
                            }
                        }
                    }
                ?>
            </form>
        </div>
    </section>
</body>
</html>