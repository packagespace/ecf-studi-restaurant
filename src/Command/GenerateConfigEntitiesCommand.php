<?php

namespace App\Command;

use App\Entity\DayOpeningHours;
use App\Entity\MaximumNumberOfGuests;
use App\Factory\DayOpeningHoursFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name       : 'app:generate-config-entities',
    description: 'Generate the mandatory config entities so they can be configured in the admin panel',
)]
class GenerateConfigEntitiesCommand extends Command
{


    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $dayOpeningHoursRepository = $this->entityManager->getRepository(DayOpeningHours::class);
        $dayOpeningHoursRepository->deleteAll();
        $this->entityManager->persist((new DayOpeningHours())
                                          ->setDayOfWeek('monday'));
        $this->entityManager->persist((new DayOpeningHours())
                                          ->setDayOfWeek('tuesday'));
        $this->entityManager->persist((new DayOpeningHours())
                                          ->setDayOfWeek('wednesday'));
        $this->entityManager->persist((new DayOpeningHours())
                                          ->setDayOfWeek('thursday'));
        $this->entityManager->persist((new DayOpeningHours())
                                          ->setDayOfWeek('friday'));
        $this->entityManager->persist((new DayOpeningHours())
                                          ->setDayOfWeek('saturday'));
        $this->entityManager->persist((new DayOpeningHours())
                                          ->setDayOfWeek('sunday'));

        $maximumNumberOfGuestsRepository = $this->entityManager->getRepository(MaximumNumberOfGuests::class);
        $maximumNumberOfGuestsRepository->deleteAll();
        $this->entityManager->persist((new MaximumNumberOfGuests())
                                          ->setMaximumNumberOfGuests(100));

        $this->entityManager->flush();
        $io->success('Successfully cleared and recreated entities!');
        return Command::SUCCESS;
    }
}
