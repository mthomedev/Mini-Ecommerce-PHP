<?php
session_start();
header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    if (isset($_SESSION['carrinho'][$id])) {
        // Remove o item
        unset($_SESSION['carrinho'][$id]);
        
        // Calcula a nova quantidade de itens no carrinho
        $cartCount = 0;
        foreach ($_SESSION['carrinho'] as $qtd) {
            $cartCount += $qtd; // ou apenas count($_SESSION['carrinho']) dependendo da sua regra
        }

        // Retorna o JSON de sucesso esperado pelo JS
        echo json_encode([
            'success' => true,
            'message' => 'Produto removido com sucesso!',
            'cartCount' => $cartCount
        ]);
        exit;
    }
}

// Retorna o JSON de erro se algo falhar
echo json_encode([
    'success' => false,
    'message' => 'Erro: Produto não encontrado.'
]);
exit;
?>