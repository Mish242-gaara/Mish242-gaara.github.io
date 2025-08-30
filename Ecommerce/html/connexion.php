

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
            <h1><span>C</span>onnexion</h1>
            <img src="../images/inscipt.png" alt="">
        </div>

        <div class="rigth">
            <form action="" method ="post">
                 <div class="formItem">
                    <label for="email">Email</label><br>
                    <input type="text" placeholder="Entrez votre email" name="email">
                    
                </div>
                 <div class="formItem">
                    <label for="password">Mot de passe</label><br>
                    <input type="password" placeholder="Entrez votre mot de passe" name="mdp">
                </div>
                
                <input type="submit" class="bouton" value="Se connecter" name="connect">
                <h5 class="signOrLog">Pas encore de compte ? <a href="index.php">Inscrivez-vous</a></h5>

                <?php
                    require '../config/connexionBDD.php';
                    if(isset($_POST["connect"])){
                        $email = trim($_POST["email"]);
                        $mdp = $_POST["mdp"];

                        // Validation des champs
                        if(empty($email) || empty($mdp)){
                            echo '<p style="color:red;">Veuillez remplir tous les champs.</p>';
                        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            echo '<p style="color:red;">Email invalide.</p>';
                        } else {
                            // Vérifier si l'utilisateur existe
                            $stmt = $pdo->prepare("SELECT mdp FROM utilisateurs WHERE email = ?");
                            $stmt->execute([$email]);
                            $user = $stmt->fetch();
                            if($user){
                                if(password_verify($mdp, $user['mdp'])){
                                    // Redirection vers produits.php après connexion réussie
                                    header('Location: produits.php');
                                    exit();
                                } else {
                                    echo '<p style="color:red;">Email ou mot de passe incorrect.</p>';
                                }
                            } else {
                                echo '<p style="color:red;">Email ou mot de passe incorrect.</p>';
                            }
                        }
                    }
                ?>
            </form>
        </div>
    </section>
</body>
</html>