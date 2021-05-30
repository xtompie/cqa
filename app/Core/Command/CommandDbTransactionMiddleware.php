<?php

namespace App\Core\Command;

use Exception;
use Illuminate\Database\Connection;
use Xtompie\Lainstance\Instance;
use Xtompie\Lainstance\Shared;

class CommandDbTransactionMiddleware implements CommandMiddlewareInterface, Shared
{
    use Instance;

    public function __construct(
        protected CommandHandlerProvider $handlers,
        protected Connection $db,
    ) {}

    public function execute(object $command, $next): ?object 
    {
        if ($this->handlers->provide($command) instanceof CommandDbTransactionInterface) {
            try {
                $this->db->beginTransaction();
                $result = $next($command);
                $this->db->commit();
                return $result;
            } 
            catch(Exception $e) {
                $this->db->rollBack();
                return CommandResult::ofErrorMsg('Internal error', 'internal');
            }
        }

        return $next($command);
    }
}
