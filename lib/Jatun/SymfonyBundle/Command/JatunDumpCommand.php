<?php

namespace Jatun\SymfonyBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Dumps jatun javascript to the filesystem.
 *
 * @author Arno Geurts
 */
class JatunDumpCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('jatun:dump')
            ->setDescription('Dumps the jatun javascript to the filesystem')
            ->addArgument('path', InputArgument::REQUIRED, 'Define the path where to write the javascript file to')
            ->addOption('filename', 'f', InputOption::VALUE_OPTIONAL, 'Define the filename of the jatun javascript file', 'jatun.js')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dir = rtrim($input->getArgument('path'), DIRECTORY_SEPARATOR);
        
        if (!is_dir($dir)) {
            throw new \InvalidArgumentException(sprintf('The target directory "%s" does not exist.', $path));
        }
        
        $path = $dir . DIRECTORY_SEPARATOR . $input->getOption('filename');
        $output->writeln(sprintf('Dumping the javascript file to <comment>%s</comment>.', $path));
        
        $jatunEnv = $this->getContainer()->get('jatun.environment');
        
        $handle = @fopen($path, 'w');
        $success = $handle && fwrite($handle, $jatunEnv->createJavascript());
        fclose($handle);
        
        if ( ! $success) {
            throw new \Exception(sprintf("Failed to write to file %s", $path));
        }
    }
}
