<?php

namespace NW\RequestLimitBundle\Command;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class MySQLProviderSetupCommand
 * @package NW\RequestLimitBundle\Command
 * @author Novikov Viktor
 */
class MySQLProviderSetupCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('nw:request-limit:mysql-init')
            ->setDescription('Creates a table in your project database to store keys')
            ->setHelp('This command initializes MySQL provider workflow');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws DBALException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Connection $connection */
        $connection = $this->getContainer()->get('doctrine.orm.default_entity_manager')->getConnection();
        $connection->exec(
            'CREATE TABLE nw_request_limit_items (item_key VARCHAR(30) PRIMARY KEY, expires_at TIMESTAMP);'
        );
        $connection->close();
    }
}
