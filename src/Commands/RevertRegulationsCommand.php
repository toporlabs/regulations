<?php

namespace Regulations\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Regulations\Services\CommandService as Service;

/**
 * RevertConfigCommand class
 *
 * This class reverts the requested file from backup directory.
 *
 * Example usage:
 * To revert .env file just call in console:
 *
 * php artisan config:revert .env your_app_name
 * (your_app_name is the name of the folder in a remote repository where the file is located)
 *
 * @package  Regulations
 * @author   Cezary Strąk <cezary.strak@upaid.pl>
 */
class RevertRegulationsCommand extends Command
{
    /**
     * RevertConfigCommand constructor.
     *
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->cfgService = $service;
        parent::__construct();
    }

    /**
     * Command service
     *
     * @var Service
     */
    public $cfgService;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revert application config from backup directory.';

    /**
     * Configure command
     */
    protected function configure()
    {
        $this
            ->setName('regulations:revert {param}')
            ->setDescription('Revert application config from backup directory.')
            ->setAliases(['revertConfig'])
            ->setDefinition(
                [new InputArgument('fileName', InputArgument::REQUIRED),
                new InputArgument('appName', InputArgument::OPTIONAL),]
            );
    }

    /**
     * Executes the console command.
     *
     * @return mixed
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $fileName = $input->getArgument('fileName');
        $appName = $input->getArgument('appName');
        if (is_dir('regulations_backup') && file_exists('regulations_backup/' . $fileName . '.bc')) {
            $output->writeln('Trying to revert ' . $fileName . ' file from backup directory...');
            $message = $this->revertFromBc($fileName, $appName) ?
                'File reverted successfully!' :
                'File revert failed! If You trying to revert file other than .env, please add second parameter app_name!';
            $output->writeln($message);
        } else {
            $output->writeln('Backup does not exist!');
        }
    }

    /**
     * Reverts requested file from backup directory.
     *
     * @param $fileName
     * @param $appName
     *
     * @return bool
     */
    private function revertFromBc($fileName, $appName)
    {
        $filePath = $this->cfgService->getFilePath($fileName, $appName);

        return copy('regulations_backup/' . $fileName . '.bc', $filePath);
    }
}