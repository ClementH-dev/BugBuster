<?php
namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[AsCommand(
    name: 'app:test-mailer',
    description: 'Test email sending functionality',
)]
class TestMailerCommand extends Command
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::OPTIONAL, 'Email address to send to', 'your@email.com')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $recipient = $input->getArgument('email');
        
        try {
            $email = (new Email())
                ->from('noreply@votreapp.com')
                ->to($recipient)
                ->subject('Test email from Symfony')
                ->text('This is a test email sent from Symfony console command.');
               
            $this->mailer->send($email);
           
            $io->success('Email sent successfully to: ' . $recipient);
        } catch (\Exception $e) {
            $io->error('Failed to send email: ' . $e->getMessage());
        }
       
        return Command::SUCCESS;
    }
}