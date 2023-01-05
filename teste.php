<?php

$conexao = new PDO("pgsql:host=localhost;port=5432;dbname=seo;user=postgres;password=Felipe@123");

$sql = $conexao->query("SELECT * FROM usuario");
while($ln = $sql->fetch(PDO::FETCH_ASSOC)) {
    echo $ln['nome'];
}
