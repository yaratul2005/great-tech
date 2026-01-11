<?php
// Artisan commands for shared hosting (without CLI access)

// Define the base path to your Laravel installation
$basePath = dirname(__DIR__); // Go up one level from public/

// Change to the base directory to run artisan commands
chdir($basePath);

// Check if this is being accessed directly (not via command line)
if (php_sapi_name() !== 'cli') {
    // Verify the user is accessing this securely (optional - you can add auth here)
    // For production, you'd want to add authentication
    
    echo "<h2>Laravel Artisan Commands Runner</h2>";
    
    // Available commands
    $availableCommands = [
        'config:clear' => 'Clear configuration cache',
        'cache:clear' => 'Clear application cache',
        'view:clear' => 'Clear compiled views',
        'route:clear' => 'Remove cached routes',
        'optimize:clear' => 'Remove cached bootstrap files',
    ];
    
    if (isset($_GET['cmd']) && in_array($_GET['cmd'], array_keys($availableCommands))) {
        $command = $_GET['cmd'];
        
        echo "<h3>Running: php artisan {$command}</h3>";
        echo "<pre>";
        
        // Execute the artisan command
        $output = [];
        $returnCode = 0;
        exec("php artisan {$command}", $output, $returnCode);
        
        foreach ($output as $line) {
            echo htmlspecialchars($line) . "\n";
        }
        
        if ($returnCode !== 0) {
            echo "Command failed with return code: {$returnCode}\n";
        } else {
            echo "Command completed successfully!\n";
        }
        
        echo "</pre>";
    } else {
        echo "<p>Select a command to run:</p>";
        echo "<ul>";
        foreach ($availableCommands as $cmd => $desc) {
            echo '<li><a href="?cmd=' . urlencode($cmd) . '">' . $cmd . '</a> - ' . $desc . '</li>';
        }
        echo "</ul>";
        echo "<p><strong>Note:</strong> Remove this file after use for security!</p>";
    }
} else {
    // Running via CLI
    echo "This script is meant to be run via web request, not CLI.\n";
}
?>