<?php

namespace SymfonyDevCli\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Process;

class CreateProjectCommand extends Command
{
    protected static $defaultName = 'create-project';

    protected function configure()
    {
        $this
            ->setDescription('Create a new Symfony project')
            ->setHelp('Allows you to create a new Symfony project. Symfony CLI is used in the background to create the project and also Symfony DEV will be set up.')
            ->addOption(
                'project-version',
                null,
                InputOption::VALUE_OPTIONAL,
                'The version of the Symfony skeleton (a version or one of "lts", "stable", "next", or "previous")',
                'stable'
            )
            ->addOption(
                'full',
                null,
                InputOption::VALUE_NONE,
                'Use github.com/symfony/website-skeleton'
            )
            ->addArgument(
                'directory',
                InputArgument::REQUIRED,
                'Directory of the project to create'
            )
            ->addArgument(
                'symfony-cli-args',
                InputArgument::IS_ARRAY,
                'Pass additional arguments/options to Symfony CLI (requires -- to be used)'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Symfony DEV CLI');

        if (str_starts_with($input->getArgument('directory'), '/')) {
            $io->error('Direcotry must be a relativ path.');
            return Command::INVALID;
        }

        $io->section('Creating project using Symfony CLI');
        $process = new Process(
            array_merge(
                ['symfony', 'local:new'],
                ['--version', $input->getOption('project-version')],
                $input->getOption('full') ? ['--full'] : [],
                ['--dir', $input->getArgument('directory')],
                $input->getArgument('symfony-cli-args')
            )
        );
        $process->mustRun();
        echo $process->getOutput();
        unset($process);

        $io->section('Setting up Symfony DEV');

        $directory = realpath(getcwd() . '/' . $input->getArgument('directory'));
        if (!$directory || !is_dir($directory) || !file_exists($directory . '/composer.json')) {
            $io->error('Unknown error creating project, some mandatory files where not found.');
            return Command::FAILURE;
        }
        if (!chdir($directory)) {
            $io->error('Unable to change working directory.');
            return Command::FAILURE;
        }

        $process = new Process(['composer', 'require', '--dev', 'wiet-at/symfony-dev:dev-main@dev']);
        $process->mustRun();
        unset($process);

        $io->success('Done');

        return Command::SUCCESS;
    }
}
