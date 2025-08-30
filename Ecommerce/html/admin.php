<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Quicksand', 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(120deg, #f8fafc 0%, #e0e7ef 100%);
            min-height: 100vh;
        }
        .global {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: transparent;
            padding-bottom: 40px;
        }
        .btnhorizontal {
            display: flex;
            gap: 20px;
            margin: 30px 0 25px 0;
            justify-content: center;
        }
        .bouton {
            padding: 12px 32px;
            border: none;
            border-radius: 25px;
            background: linear-gradient(90deg, #ff4d4d 0%, #ff7e5f 100%);
            color: #fff;
            font-weight: bold;
            font-size: 1.1em;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(255,77,77,0.08);
            transition: background 0.2s, transform 0.2s;
        }
        .bouton:hover {
            background: linear-gradient(90deg, #ff1a1a 0%, #ff7e5f 100%);
            transform: translateY(-2px) scale(1.04);
        }
        .transparent {
            width: 100%;
            max-width: 1200px;
            min-height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(255,255,255,0.97);
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(44,62,80,0.10), 0 1.5px 4px rgba(255,77,77,0.08);
            margin-bottom: 30px;
        }
        #element1, #element2, #element3 {
            width: 340px;
            min-height: 70vh;
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: #f8fafc;
            border-radius: 14px;
            margin: 18px auto;
            box-sizing: border-box;
            box-shadow: 0 2px 8px rgba(44,62,80,0.04);
            padding: 30px 24px 24px 24px;
        }
        #element2 { display: flex; }
        #element1 h3, #element2 h3, #element3 h3 {
            text-align: center;
            margin-bottom: 24px;
            font-size: 1.35em;
            color: #ff4d4d;
            letter-spacing: 1px;
            font-weight: 700;
            text-shadow: 0 1px 0 #fff, 0 2px 8px #ffb3b3;
        }
        .formItem {
            margin-bottom: 18px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .formItem label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
            color: #333;
            letter-spacing: 0.5px;
        }
        .formItem input[type="text"],
        .formItem input[type="number"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 1em;
            background: #fff;
            transition: border 0.2s;
        }
        .formItem input[type="text"]:focus,
        .formItem input[type="number"]:focus {
            border: 1.5px solid #ff4d4d;
            outline: none;
        }
        .formItem textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            resize: none;
            box-sizing: border-box;
            font-size: 1em;
            background: #fff;
            min-height: 70px;
            transition: border 0.2s;
        }
        .formItem textarea:focus {
            border: 1.5px solid #ff4d4d;
            outline: none;
        }
        .formItem input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(90deg, #ff4d4d 0%, #ff7e5f 100%);
            color: #fff;
            font-weight: bold;
            font-size: 1.08em;
            cursor: pointer;
            outline: none;
            box-shadow: 0 1.5px 4px rgba(255,77,77,0.08);
            transition: background 0.2s, transform 0.2s;
        }
        .formItem input[type="submit"]:hover {
            background: linear-gradient(90deg, #ff1a1a 0%, #ff7e5f 100%);
            transform: translateY(-2px) scale(1.03);
        }
        @media (max-width: 1100px) {
            .scroller {
                flex-direction: column;
                gap: 0;
                align-items: center;
                width: 100%;
                transform: none !important;
            }
            #element1, #element2, #element3 {
                width: 95%;
                margin: 18px auto;
            }
            .transparent {
                width: 98%;
            }
        }
    </style>
</head>
<body>
    <?php
    require '../config/connexionBDD.php';
    // Ajouter un produit
    if(isset($_POST['ajouter'])){
        $nom = trim($_POST['nomProduit']);
        $desc = trim($_POST['description']);
        $prix = floatval($_POST['prix']);
        $img = trim($_POST['img']);
        if(empty($nom) || empty($desc) || empty($prix) || empty($img)){
            echo '<p style="color:red;">Veuillez remplir tous les champs pour ajouter un produit.</p>';
        } else {
            $stmt = $pdo->prepare("INSERT INTO produits (nomProduit, description, prix, img) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nom, $desc, $prix, $img]);
            echo '<p style="color:green;">Produit ajouté avec succès.</p>';
        }
    }
    // Modifier un produit
    if(isset($_POST['modifier'])){
        $id = intval($_POST['idProduit']);
        $nom = trim($_POST['nomProduit']);
        $desc = trim($_POST['description']);
        $prix = floatval($_POST['prix']);
        $img = trim($_POST['img']);
        if(empty($id) || empty($nom) || empty($desc) || empty($prix) || empty($img)){
            echo '<p style="color:red;">Veuillez remplir tous les champs pour modifier un produit.</p>';
        } else {
            $stmt = $pdo->prepare("UPDATE produits SET nomProduit=?, description=?, prix=?, img=? WHERE id=?");
            $stmt->execute([$nom, $desc, $prix, $img, $id]);
            echo '<p style="color:green;">Produit modifié avec succès.</p>';
        }
    }
    // Supprimer un produit
    if(isset($_POST['supprimer'])){
        $id = intval($_POST['idProduit']);
        if(empty($id)){
            echo '<p style="color:red;">Veuillez indiquer l\'ID du produit à supprimer.</p>';
        } else {
            $stmt = $pdo->prepare("DELETE FROM produits WHERE id=?");
            $stmt->execute([$id]);
            echo '<p style="color:green;">Produit supprimé avec succès.</p>';
        }
    }
    ?>
        <div class="btnhorizontal">
            <button class="bouton" id="modifier">Modifier</button>
            <button class="bouton" id="ajouter">Ajouter</button>
            <button class="bouton" id="supprimer">Supprimer</button>
        </div>

        <div class="transparent">
            <div id="element1">
                    <h3>Modifier un produit</h3>
                    <form action="" method="post">
                        <div class="formItem">
                            <label for="idProduit">Id du produit</label><br>
                            <input type="number" name="idProduit" placeholder="Id du produit">
                        </div>
                        <div class="formItem">
                            <label for="nomProduit">Nom du produit</label><br>
                            <input type="text" name="nomProduit" placeholder="Nom du produit">
                        </div>
                        <div class="formItem">
                            <label for="description">Description</label><br>
                            <textarea name="description" rows="4" cols="50"></textarea>
                        </div>
                        <div class="formItem">
                            <label for="prix">Prix du produit</label><br>
                            <input type="number" name="prix" step="0.01" placeholder="Prix du produit">
                        </div>
                        <div class="formItem">
                            <label for="img">Image (nom du fichier)</label><br>
                            <input type="text" name="img" placeholder="Nom du fichier image">
                        </div>
                        <div class="formItem">
                            <input type="submit" name="modifier" value="Modifier le produit">
                        </div>
                    </form>
                </div>
                <div id="element2">
                    <h3>Ajouter un produit</h3>
                    <form action="" method="post">
                        <div class="formItem">
                            <label for="nomProduit">Nom du produit</label><br>
                            <input type="text" name="nomProduit" placeholder="Nom du produit">
                        </div>
                        <div class="formItem">
                            <label for="description">Description</label><br>
                            <textarea name="description" rows="4" cols="50"></textarea>
                        </div>
                        <div class="formItem">
                            <label for="prix">Prix du produit</label><br>
                            <input type="number" name="prix" step="0.01" placeholder="Prix du produit">
                        </div>
                        <div class="formItem">
                            <label for="img">Image (nom du fichier)</label><br>
                            <input type="text" name="img" placeholder="Nom du fichier image">
                        </div>
                        <div class="formItem">
                            <input type="submit" name="ajouter" value="Ajouter le produit">
                        </div>
                    </form>
                </div>
                <div id="element3">
                    <h3>Supprimer un produit</h3>
                    <form action="" method="post">
                        <div class="formItem">
                            <label for="idProduit">Id du produit</label><br>
                            <input type="number" name="idProduit" placeholder="Id du produit">
                        </div>
                        <div class="formItem">
                            <input type="submit" name="supprimer" value="Supprimer le produit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        const forms = [
            document.getElementById('element1'),
            document.getElementById('element2'),
            document.getElementById('element3')
        ];
        const btns = [
            document.getElementById('modifier'),
            document.getElementById('ajouter'),
            document.getElementById('supprimer')
        ];
        function showForm(idx) {
            forms.forEach((f, i) => f.style.display = (i === idx) ? 'flex' : 'none');
            btns.forEach((b, i) => b.classList.toggle('active', i === idx));
        }
        showForm(1); // Affiche "Ajouter" par défaut
        btns.forEach((b, i) => b.onclick = () => showForm(i));
    </script>
    
</body>
</html>