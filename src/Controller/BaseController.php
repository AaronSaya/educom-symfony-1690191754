<?php 

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    private $logger;
    
    protected function log($msg, $logLevel) {
        switch ($logLevel) {
            case 'info':
                $this->logger->info($msg);
                break;
            case 'warning':
                $this->logger->warning($msg);
                break;
            case 'error':
                $this->logger->error($msg);
                break;
            default:
                // Standaard actie als het opgegeven logniveau niet wordt herkend
                $this->logger->info($msg);
                break;
        }
    }
    
    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    } 
}