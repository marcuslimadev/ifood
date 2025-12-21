<?php
/**
 * Script para corrigir problema de rotas
 * Execute: php fix_routes.php
 */

echo "Iniciando limpeza de cache e rotas...\n";

// Require autoloader
require __DIR__ . '/vendor/autoload.php';

// Create app instance
$app = require_once __DIR__ . '/bootstrap/app.php';

// Get the kernel
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

// Clear caches
$commands = [
    'cache:clear',
    'route:clear',
    'config:clear',
    'view:clear',
];

foreach ($commands as $command) {
    try {
        echo "Executando: php artisan $command\n";
        exec("cd " . __DIR__ . " && php artisan $command");
        echo "✓ $command executado com sucesso\n";
    } catch (\Exception $e) {
        echo "✗ Erro em $command: " . $e->getMessage() . "\n";
    }
}

echo "\nLimpeza concluída!\n";
echo "Próximos passos:\n";
echo "1. Faça upload do arquivo atualizado para o servidor\n";
echo "2. Execute 'php artisan cache:clear' no servidor\n";
echo "3. Teste a rota novamente\n";
?>
