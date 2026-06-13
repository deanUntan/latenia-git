<?php
try {
    $pdo = new PDO('pgsql:host=db.cxbaemfoiokjieamnnls.supabase.co;port=5432;dbname=postgres', 'postgres', 'Hellosupabase123');
    echo "SUCCESS: Connected to Supabase!\n";
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
