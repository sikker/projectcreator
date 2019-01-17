<?php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class NewProjectCommand extends Command
{
    const TEMPLATE_PATH = __DIR__.'/../../data/template';
    protected static $defaultName = 'project:new';

    protected function configure()
    {
        $this->setDescription('Begin a new Phinatra/NotNoSQL project');
        $this->setHelp('Input the vendor name and package name and a basic project will be started for you in the package directory');
        $this->addArgument('vendor', InputArgument::REQUIRED, 'vendor name (ie "symfony")');
        $this->addArgument('package', InputArgument::REQUIRED, 'package/application name (ie "console")');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
       $values = [
           '%VENDOR%' => $input->getArgument('vendor'),
           '%PACKAGE%' => $input->getArgument('package')
       ];

       $composer = file_get_contents(self::TEMPLATE_PATH.'/composer.json.tpl');
       $composer = strtr($composer, $values);
       $application = file_get_contents(self::TEMPLATE_PATH.'/index.php.tpl');
       $application = strtr($application, $values);

       mkdir($input->getArgument('package') . '/');
       file_put_contents($input->getArgument('package').'/composer.json', $composer);
       file_put_contents($input->getArgument('package').'/index.php', $application);
       shell_exec('cd ' . $input->getArgument('package') . ' && php '.$_SERVER['HOME'].'/bin/composer install');
       $output->writeln('-------------------------------------------------');
       $output->writeln('All done! Remember to edit composer.json!');
       $output->writeln('You can see your project in action by navigating to the package directory and starting the builtin PHP development server:');
       $output->writeln(' cd '.$input->getArgument('package').'/');
       $output->writeln(' php -S localhost:1234');
    }
}
