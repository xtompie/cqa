<?php

namespace App\Core\Command;

use Exception;
use Illuminate\Database\Connection;
use Xtompie\Lainstance\Instance;
use Xtompie\Lainstance\Shared;

class DbTransactionMiddleware implements MiddlewareInterface, Shared
{
    use Instance;

    public function __construct(
        protected HandlerProvider $handlers,
        protected Connection $db,
    ) {}

    public function execute(object $command, $next): ?object 
    {
        if ($this->handlers->provide($command) instanceof DbTransactionInterface) {
            try {
                $this->db->beginTransaction();
                $result = $next($command);
                $this->db->commit();
                return $result;
            } 
            catch(Exception $e) {
                $this->db->rollBack();
                return Result::ofErrorMsg('Internal error', 'internal');
            }
        }

        return $next($command);
    }
}
