<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Service\CBRFPeriodRatesLoader;
use App\Model\CurrencyRate;
use App\Model\Currency;
use WouterJ\EloquentBundle\Facade\Db;

class LoadCurrencyRatesCommand extends Command
{
    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('app:load-rates');
        $this->setDescription('Load currency rates by CBRF api and save them in the db.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        Db::beginTransaction();

        try {
            $loader = new CBRFPeriodRatesLoader();

            $endDate = $loader->getLastUpdateDate();
            $beginDate = $endDate->copy()->subYear();

            $columnItems = Currency::select('cbrf_id')->get();


            $io = new SymfonyStyle($input, $output);
            $io->progressStart(count($columnItems));


            CurrencyRate::truncate();

            foreach ($columnItems as $item) {
                $rates = $loader->loadRatesForPeriod($beginDate, $endDate, $item->cbrf_id);
                $currencyId = Currency::where('cbrf_id', $item->cbrf_id)->value('id');

                if ($rates === []) {
                    $currencyRateModel = new CurrencyRate();
                    $currencyRateModel->currency_rate = null;
                    $currencyRateModel->date = null;
                    $currencyRateModel->currency_id = $currencyId;
                    $currencyRateModel->save();
                }

                foreach ($rates as $rate) {
                    $currencyRateModel = new CurrencyRate();
                    $currencyRateModel->currency_rate = $rate['rate'];
                    $currencyRateModel->date = $rate['date'];
                    $currencyRateModel->currency_id = $currencyId;
                    $currencyRateModel->save();
                }

                $io->progressAdvance();
            }
        } catch (\Exception $e) {
            $io->error('An error occurred while loading data.');
            return Command::FAILURE;
        }

        Db::commit();

        $io->progressFinish();
        $io->success('Currency rates loaded.');
        return Command::SUCCESS;
    }
}
