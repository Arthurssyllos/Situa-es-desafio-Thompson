<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contagem de Domínios de E-mail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right top, #92a8d1, #88d8b0);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .container {
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        textarea {
            width: calc(100% - 20px);
            height: 200px;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            resize: vertical;
        }

        button {
            display: block;
            margin: 0 auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        pre {
            margin-top: 20px;
            padding: 10px;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 4px;
            overflow-x: auto;
        }

        .resultado {
            margin-top: 20px;
        }

        .resultado ul {
            list-style-type: none;
            padding: 0;
        }

        .resultado li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="container">
            <h1>Contagem de Domínios de E-mail</h1>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <textarea name="emails" placeholder="Insira uma lista de endereços de e-mail, um por linha..." required></textarea>
                <button type="submit">Contar Domínios</button>
            </form>
            <div class="resultado">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST["emails"])) {
                        $emails = explode("\n", $_POST["emails"]);
                        $resultado = contarDominios($emails);
                        echo "<h2>Domínios encontrados:</h2>";
                        echo "<ul>";
                        foreach ($resultado as $dominio => $quantidade) {
                            echo "<li>$dominio: $quantidade</li>";
                        }
                        echo "</ul>";

                        // Criar arquivo JSON
                        $json_data = [];
                        foreach ($emails as $email) {
                            $email = trim($email); // Remover espaços em branco extras
                            $partes = explode('@', $email);
                            if (count($partes) == 2) {
                                $nome = $partes[0];
                                $dominio = $partes[1];
                                if (array_key_exists($dominio, $json_data)) {
                                    $json_data[$dominio][] = $nome;
                                } else {
                                    $json_data[$dominio] = [$nome];
                                }
                            }
                        }

                        $json = json_encode($json_data, JSON_PRETTY_PRINT);
                        file_put_contents('dominios.json', $json);
                        echo "<p>Os resultados foram salvos com sucesso!</p>";
                    }
                }

                function contarDominios($emails) {
                    $dominios = [];

                    foreach ($emails as $email) {
                        $partes = explode('@', $email);
                        $dominio = end($partes);

                        if (array_key_exists($dominio, $dominios)) {
                            $dominios[$dominio]++;
                        } else {
                            $dominios[$dominio] = 1;
                        }
                    }

                    arsort($dominios);

                    return $dominios;
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
