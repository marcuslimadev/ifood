<?php
// Limpar cache do Laravel
exec('php artisan cache:clear');
exec('php artisan config:cache');
echo "Cache limpo com sucesso!";
?>
