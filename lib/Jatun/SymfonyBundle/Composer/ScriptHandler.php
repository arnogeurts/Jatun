<?php

namespace Jatun\SymfonyBundle\Composer;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\PhpExecutableFinder;

/**
 * @author Arno Geurts
 */
class ScriptHandler
{
    /**
     * Dump the jatun javascript
     * 
     * @param unknown $event
     * @throws \RuntimeException
     */
    public static function dumpJatun($event)
    {
        $options = sef::getOptions($event);
        $process = new Process(self::getPhp().' '.self::getConsole($options).' '.self::getCommand());
        $process->run(function ($type, $buffer) { echo $buffer; });
        
        if (!$process->isSuccessful()) {
            throw new \RuntimeException('An error occurred when executing the "jatun:dump" command.');
        }
    }
    
    /**
     * Get the symfony options
     * 
     * @param unknown $event
     * @return array
     */
    protected static function getOptions($event)
    {
        $options = array_merge(array(
                'symfony-app-dir' => 'app',
                'symfony-web-dir' => 'web'
        ), $event->getComposer()->getPackage()->getExtra());
    
        return $options;
    }
    
    /**
     * Get the console path
     * 
     * @param array $options
     * @throws \RuntimeException
     * @return string
     */
    protected static function getConsole(array $options)
    {
        $appDir = $options['symfony-app-dir'];
        
        if (!is_dir($appDir)) {
            throw new \RuntimeException('The symfony-app-dir ('.$appDir.') specified in composer.json was not found in '.getcwd().', can not dump jatun javascript.');
        }
        
        return escapeshellarg($appDir.'/console');
    }
    
    /**
     * Get the command to execute
     * 
     * @param array $options
     * @return string
     */
    protected static function getCommand(array $options)
    {
        return 'jatun:dump '.getJatunDir($options).' --filename '.self::getJatunFilename();
    }
    
    /**
     * Get the filename for the jatun file
     * 
     * @return string
     */
    protected static function getJatunFilename()
    {
        return 'jatun.js';
    }
    
    /**
     * Get the directory to dump the jatun file in
     * 
     * @param array $options
     * @throws \RuntimeException
     * @return string
     */
    protected static function getJatunDir(array $options)
    {
        $dir = rtrim($options['symfony-web-dir'], '/') . '/js'; 
        if (!is_dir($dir)) {
            throw new \RuntimeException('The symfony-web-dir ('.$dir.') specified in composer.json was not found in '.getcwd().', can not dump jatun javascript.');
        }
        
        return $dir;
    }

    /**
     * Get the php executable 
     * 
     * @throws \RuntimeException
     * @return string
     */
    protected static function getPhp()
    {
        $phpFinder = new PhpExecutableFinder;
        if (!$phpPath = $phpFinder->find()) {
            throw new \RuntimeException('The php executable could not be found, add it to your PATH environment variable and try again');
        }

        return escapeshellarg($phpPath);
    }
}
